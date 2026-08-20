# Convert static HTML pages to PHP templates
# Usage: pwsh -File convert.ps1

$files = Get-ChildItem -Path $PSScriptRoot -Filter "*.html" -File

foreach ($file in $files) {
    $name = $file.BaseName
    $phpFile = "$PSScriptRoot/$name.php"
    $content = Get-Content -Path $file.FullName -Raw -Encoding UTF8

    # Extract title
    $titleMatch = [regex]::Match($content, '<title>(.*?)</title>', [System.Text.RegularExpressions.RegexOptions]::Singleline)
    $title = if ($titleMatch.Success) { $titleMatch.Groups[1].Value.Trim() } else { '' }

    # Extract description
    $descMatch = [regex]::Match($content, '<meta\s+name="description"\s+content="(.*?)"', [System.Text.RegularExpressions.RegexOptions]::Singleline)
    $description = if ($descMatch.Success) { $descMatch.Groups[1].Value.Trim() } else { '' }

    # Extract all <style>...</style> content
    $styleMatches = [regex]::Matches($content, '<style>(.*?)</style>', [System.Text.RegularExpressions.RegexOptions]::Singleline)
    $styles = @()
    foreach ($m in $styleMatches) {
        $styles += $m.Groups[1].Value.Trim()
    }
    $styleContent = $styles -join "`n`n"

    # Extract content between <body> and </body>
    $bodyMatch = [regex]::Match($content, '<body>(.*?)</body>', [System.Text.RegularExpressions.RegexOptions]::Singleline)
    if (-not $bodyMatch.Success) {
        Write-Host "Skip $($file.Name): body tag not found"
        continue
    }
    $bodyContent = $bodyMatch.Groups[1].Value

    # Remove <header>...</header>
    $bodyContent = [regex]::Replace($bodyContent, '<header>.*?</header>', '', [System.Text.RegularExpressions.RegexOptions]::Singleline)

    # Remove <footer>...</footer>
    $bodyContent = [regex]::Replace($bodyContent, '<footer>.*?</footer>', '', [System.Text.RegularExpressions.RegexOptions]::Singleline)

    # Extract the last <script>...</script> in body as page-specific script
    $scriptMatches = [regex]::Matches($bodyContent, '<script>(.*?)</script>', [System.Text.RegularExpressions.RegexOptions]::Singleline)
    $pageScript = ''
    if ($scriptMatches.Count -gt 0) {
        $lastScript = $scriptMatches[$scriptMatches.Count - 1]
        $pageScript = $lastScript.Groups[1].Value.Trim()
        $bodyContent = $bodyContent.Remove($lastScript.Index, $lastScript.Length)
    }

    # Note: common toggleMenu script may be duplicated in page-specific script
    # This is harmless since footer.php also defines it (later definition wins)

    $bodyContent = $bodyContent.Trim()

    # Fix internal links: href="xxx" -> href="xxx.php"
    $bodyContent = [regex]::Replace($bodyContent, 'href="(docs[a-z0-9-]*|huodong|team|status|note|jiao|pic-1|404|index)"', 'href="$1.php"')
    $bodyContent = [regex]::Replace($bodyContent, 'href="/"', 'href="index.php"')

    # Build PHP file content
    $phpContent = @()
    $phpContent += "<?php"
    $phpContent += "/**"
    $phpContent += " * $name.php"
    $phpContent += " */"

    if ($title -ne '' -and $title -notmatch '^LuckyClover') {
        $phpContent += '$page_title = ' + (ConvertTo-Json -InputObject $title) + ';'
    }
    if ($description -ne '') {
        $phpContent += '$page_desc = ' + (ConvertTo-Json -InputObject $description) + ';'
    }

    # Navigation active state
    if ($name -eq 'index') { $activeNav = '/' }
    elseif ($name -eq 'docs' -or $name -like 'docs-*') { $activeNav = 'docs.php' }
    elseif ($name -eq 'huodong') { $activeNav = 'huodong.php' }
    elseif ($name -eq 'team') { $activeNav = 'team.php' }
    elseif ($name -eq 'status') { $activeNav = 'status.php' }
    elseif ($name -eq 'note') { $activeNav = 'note.php' }
    else { $activeNav = '' }
    if ($activeNav -ne '') {
        $phpContent += '$active_nav = ' + (ConvertTo-Json -InputObject $activeNav) + ';'
    }

    # Docs search button
    if ($name -match '^docs') {
        $phpContent += '$docs_search = true;'
    }

    # Docs sidebar active state
    if ($name -match '^docs') {
        $docUrl = if ($name -eq 'docs') { 'docs.php' } else { "$name.php" }
        $phpContent += '$active_doc = ' + (ConvertTo-Json -InputObject $docUrl) + ';'
    }

    # Extra CSS using heredoc to preserve formatting
    if ($styleContent -ne '') {
        $phpContent += '$extra_css = <<<CSS'
        $phpContent += $styleContent
        $phpContent += 'CSS;'
    }

    $phpContent += "require __DIR__ . '/includes/header.php';"
    $phpContent += "?>"
    $phpContent += ""

    # Body content
    $phpContent += $bodyContent
    $phpContent += ""

    # Footer include with extra_js using heredoc
    if ($pageScript -ne '') {
        $phpContent += "<?php"
        $phpContent += '$extra_js = <<<JS'
        $phpContent += $pageScript
        $phpContent += 'JS;'
        $phpContent += "require __DIR__ . '/includes/footer.php';"
        $phpContent += "?>"
    } else {
        $phpContent += "<?php require __DIR__ . '/includes/footer.php'; ?>"
    }

    # Write PHP file
    $phpContent -join "`n" | Set-Content -Path $phpFile -Encoding UTF8 -NoNewline
    Write-Host "Generated: $phpFile"

    # Remove original HTML file
    try {
        Remove-Item -Path $file.FullName -Force -ErrorAction Stop
        Write-Host "Removed: $($file.Name)"
    } catch {
        Write-Host "Could not remove: $($file.Name) - $($_.Exception.Message)"
    }
}

Write-Host "Conversion done."
