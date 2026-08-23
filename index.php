<?php
/**
 * index.php
 */
$page_desc = "LuckyClover Minecraft 服务器官网，查看服务器状态、活动公告、加入方式与玩家文档。";
$active_nav = "/";
$extra_css = <<<'CSS'
.home-deco {
      position: fixed;
      inset: 0;
      overflow: hidden;
      pointer-events: none;
      z-index: -1;
    }

    .home-deco span {
      position: absolute;
      width: 76px;
      height: 76px;
      border: 3px solid rgba(0, 0, 0, 0.55);
      background: rgba(90, 189, 60, 0.2);
      box-shadow: inset -8px -8px 0 rgba(0, 0, 0, 0.12);
      animation: block-float 10s ease-in-out infinite alternate;
    }

    .home-deco span:nth-child(1) { left: 8%; top: 18%; }
    .home-deco span:nth-child(2) { right: 12%; top: 24%; width: 54px; height: 54px; background: rgba(255, 223, 94, 0.2); animation-delay: -2s; }
    .home-deco span:nth-child(3) { left: 16%; bottom: 14%; width: 58px; height: 58px; background: rgba(64, 199, 96, 0.18); animation-delay: -4s; }
    .home-deco span:nth-child(4) { right: 18%; bottom: 10%; width: 92px; height: 92px; background: rgba(139, 95, 61, 0.18); animation-delay: -6s; }

    .hero-emblem {
      width: 132px;
      height: 132px;
      margin: 0 auto 18px;
      padding: 14px;
      border: 4px solid #111;
      background: rgba(16, 32, 24, 0.75);
      box-shadow: var(--shadow-block), inset -8px -8px 0 rgba(0, 0, 0, 0.18);
      animation: emblem-float 5s ease-in-out infinite alternate;
    }

    .hero-emblem img {
      width: 100%;
      height: 100%;
      display: block;
      object-fit: contain;
    }

    .server-row-title {
      display: inline-block;
      margin: 24px 0 10px;
      padding: 7px 12px;
      border: 2px solid #111;
      background: var(--accent-secondary);
      color: #102018;
      box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.35);
      font-weight: 900;
    }

    .announcement-card {
      max-width: 900px;
      margin: 0 auto;
      padding: 30px;
      border: 3px solid #111;
      background: rgba(24, 60, 40, 0.62);
      box-shadow: var(--shadow-block);
      text-align: center;
    }

    .announcement-card h2 {
      margin-bottom: 12px;
      color: var(--accent-secondary);
      font-size: clamp(1.7rem, 4vw, 2.8rem);
    }

    .section-title-bg {
      margin: -12px auto 20px;
      color: rgba(255, 223, 94, 0.08);
      font-size: clamp(3rem, 13vw, 9rem);
      font-weight: 900;
      line-height: 0.8;
      text-align: center;
      text-transform: uppercase;
      pointer-events: none;
    }

    .section-subtitle {
      max-width: 720px;
      margin: 0 auto 38px;
      color: var(--text-secondary);
      text-align: center;
    }

    .video-container {
      max-width: 1000px;
      margin: 0 auto;
    }

    .video-player {
      border: 3px solid #111;
      background: rgba(10, 21, 16, 0.82);
      box-shadow: var(--shadow-block);
      overflow: hidden;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .video-player:hover {
      transform: translate(2px, 2px);
      box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.38);
    }

    .video-wrapper {
      position: relative;
      height: 0;
      padding-bottom: 56.25%;
      overflow: hidden;
    }

    .video-wrapper iframe {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      border: 0;
      background: #000;
    }

    .video-info {
      margin-top: 26px;
      text-align: center;
    }

    .video-title,
    .specs-title {
      color: var(--text-primary);
      text-shadow: 4px 4px 0 rgba(0, 0, 0, 0.35);
    }

    .video-title {
      margin-bottom: 12px;
      font-size: clamp(1.7rem, 4vw, 2.6rem);
    }

    .video-desc,
    .specs-description,
    .spec-desc {
      color: var(--text-secondary);
      line-height: 1.75;
    }

    .specs-header {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 44px;
      text-align: center;
    }

    .minecraft-item {
      width: 76px;
      height: 76px;
      display: grid;
      place-items: center;
      margin-bottom: 22px;
      border: 4px solid #111;
      background: var(--accent-gradient);
      box-shadow: var(--shadow-block), inset -8px -8px 0 rgba(0, 0, 0, 0.2);
      color: #102018;
      font-size: 2rem;
      transform: rotate(45deg);
    }

    .minecraft-item span {
      transform: rotate(-45deg);
    }

    .specs-title {
      margin-bottom: 16px;
      font-size: clamp(2.4rem, 6vw, 4.2rem);
    }

    .specs-title span {
      color: var(--accent-secondary);
    }

    .specs-blocks {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
      gap: 26px;
      margin-bottom: 40px;
    }

    .spec-block {
      display: flex;
      gap: 24px;
      padding: 28px;
      border: 3px solid #111;
      background: rgba(24, 60, 40, 0.62);
      box-shadow: var(--shadow-block);
      position: relative;
      overflow: hidden;
    }

    .spec-block::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 7px;
      background: var(--accent-primary);
    }

    .ram-block::before { background: #3896d3; }
    .storage-block::before { background: var(--accent-secondary); }
    .network-block::before { background: #ffb626; }

    .spec-icon-container {
      flex: 0 0 76px;
      height: 76px;
      display: grid;
      place-items: center;
      border: 3px solid #111;
      background: rgba(10, 21, 16, 0.78);
      box-shadow: inset -5px -5px 0 rgba(0, 0, 0, 0.22);
      color: var(--accent-secondary);
      font-size: 2rem;
    }

    .spec-title {
      margin-bottom: 8px;
      font-size: 1.25rem;
    }

    .spec-model {
      margin-bottom: 14px;
      color: var(--accent-secondary);
      font-size: clamp(1.6rem, 4vw, 2.2rem);
      font-weight: 900;
      line-height: 1.1;
    }

    .spec-features {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-bottom: 14px;
    }

    .feature-tag,
    .specs-badge {
      border: 2px solid #111;
      background: rgba(10, 21, 16, 0.78);
      box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.32);
      color: var(--text-primary);
      font-size: 0.86rem;
      font-weight: 900;
    }

    .feature-tag {
      padding: 5px 10px;
    }

    .specs-footer {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 18px;
    }

    .specs-badge {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 12px 18px;
    }

    @media (max-width: 900px) {
      .specs-blocks {
        grid-template-columns: 1fr;
      }

      .spec-block {
        flex-direction: column;
      }
    }

    @keyframes block-float {
      from { transform: translate3d(0, 0, 0) rotate(0deg); }
      to { transform: translate3d(12px, -22px, 0) rotate(8deg); }
    }

    @keyframes emblem-float {
      from { transform: translateY(0); }
      to { transform: translateY(-10px); }
    }
CSS;
require __DIR__ . '/includes/header.php';
?>

<div class="home-deco" aria-hidden="true"><span></span><span></span><span></span><span></span></div>

  

  <section class="hero" id="home">
    <div class="container">
      <div class="hero-content">
        <div class="hero-emblem">
          <img src="images/luckyclover.png" alt="LuckyClover 图标">
        </div>
        <div class="hero-badge">
          <span class="dot"></span>
          <span>基岩版 / Java 版 / 新生存服</span>
        </div>
        <h1>探索 <span>LuckyClover</span></h1>
        <p id="uptime">服务器运行中...</p>
        <p>稳定、友好、长期运营的 Minecraft 社区。服务器已加入 <a href="https://mscpo.top/" target="_blank" rel="noopener noreferrer">mscpo 服务器集体宣传组织</a>。</p>

        <div class="server-row-title">基岩版</div>
        <div class="hero-stats">
          <div class="stat-item">
            <div class="stat-value" id="online">--</div>
            <div class="stat-label">在线玩家</div>
          </div>
          <div class="stat-item">
            <div class="stat-value" id="version">--</div>
            <div class="stat-label">版本</div>
          </div>
          <div class="stat-item">
            <div class="stat-value" id="days">--</div>
            <div class="stat-label">运行天数</div>
          </div>
        </div>

        <div class="server-row-title">Java 版</div>
        <div class="hero-stats">
          <div class="stat-item">
            <div class="stat-value" id="online-java">--</div>
            <div class="stat-label">在线玩家</div>
          </div>
          <div class="stat-item">
            <div class="stat-value" id="version-java">--</div>
            <div class="stat-label">版本</div>
          </div>
          <div class="stat-item">
            <div class="stat-value" id="days-java">--</div>
            <div class="stat-label">运行天数</div>
          </div>
        </div>

        <div class="server-row-title">新生存服</div>
        <div class="hero-stats">
          <div class="stat-item">
            <div class="stat-value" id="online-survival">--</div>
            <div class="stat-label">在线玩家</div>
          </div>
          <div class="stat-item">
            <div class="stat-value" id="version-survival">--</div>
            <div class="stat-label">版本</div>
          </div>
          <div class="stat-item">
            <div class="stat-value" id="status-survival">检测中</div>
            <div class="stat-label">状态</div>
          </div>
        </div>

        <div class="server-row-title">Java版生存服</div>
        <div class="hero-stats">
          <div class="stat-item">
            <div class="stat-value" id="online-test">--</div>
            <div class="stat-label">在线玩家</div>
          </div>
          <div class="stat-item">
            <div class="stat-value" id="version-test">--</div>
            <div class="stat-label">版本</div>
          </div>
          <div class="stat-item">
            <div class="stat-value" id="status-test">检测中</div>
            <div class="stat-label">状态</div>
          </div>
        </div>

        <div class="hero-buttons">
          <a href="jiao" class="btn btn-primary">立即加入</a>
          <a href="status" class="btn btn-secondary">查看服务器状态</a>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="announcement-card">
        <h2>服务器公告</h2>
        <p>目前暂无正在进行的活动。后续活动、维护与更新会在网站和群公告同步发布。</p>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2>快捷<span>导航</span></h2>
        <p>快速访问服务器常用页面。</p>
      </div>
      <div class="links-grid">
        <a href="docs" class="link-card">
          <div class="icon">📚</div>
          <div class="info">
            <h4>玩家文档</h4>
            <p>查看规则、指令、新手指南和常见问题。</p>
          </div>
        </a>
        <a href="status" class="link-card">
          <div class="icon">📊</div>
          <div class="info">
            <h4>服务器状态</h4>
            <p>实时查看在线人数、版本和 MOTD。</p>
          </div>
        </a>
        <a href="huodong" class="link-card">
          <div class="icon">🎉</div>
          <div class="info">
            <h4>活动页面</h4>
            <p>查看当前活动和历史活动记录。</p>
          </div>
        </a>
        <a href="team" class="link-card">
          <div class="icon">👥</div>
          <div class="info">
            <h4>管理团队</h4>
            <p>认识维护服务器的伙伴们。</p>
          </div>
        </a>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2>服务器<span>特色</span></h2>
        <p>像素方块外壳，稳定友好的生存内核。</p>
      </div>
      <div class="features-grid">
        <div class="feature-card">
          <div class="feature-icon">⚙️</div>
          <h3>实用模组</h3>
          <p>在保证公平性的前提下引入实用功能，提升日常体验。</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">🧭</div>
          <h3>平衡玩法</h3>
          <p>生存、建造、探索都有清晰规则，新手也能快速融入。</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">🛡</div>
          <h3>反作弊</h3>
          <p>严格禁止外挂和恶意破坏，保障长期游玩环境。</p>
        </div>
        <div class="feature-card">
          <div class="feature-icon">📜</div>
          <h3>白名单制</h3>
          <p>通过申请审核加入，降低恶意玩家干扰。</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="section-header">
        <h2>精彩<span>视频展示</span></h2>
        <div class="section-title-bg">VIDEO</div>
        <p class="section-subtitle">观看服务器精彩视频，了解游戏玩法和最新活动</p>
      </div>

      <div class="video-container">
        <div class="video-player" id="videoPlayer">
          <div class="video-wrapper">
            <iframe id="videoFrame" src="https://player.bilibili.com/player.html?isOutside=true&aid=116713639188037&bvid=BV1YqEg6YE8G&cid=38955254533&p=1" title="LuckyClover 精彩视频" allowfullscreen></iframe>
          </div>
        </div>
        <div class="video-info">
          <h3 class="video-title" id="videoTitle">精彩视频</h3>
          <p class="video-desc" id="videoDesc">欢迎观看我们的服务器介绍视频，这里展示了服务器的精彩内容和各种特色玩法。</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section specifications">
    <div class="container">
      <div class="specs-header">
        <div class="minecraft-item"><span>🖥</span></div>
        <h2 class="specs-title">顶级<span>硬件配置</span></h2>
        <p class="specs-description">我们的服务器拥有顶级配置，确保你的游戏体验无比流畅</p>
      </div>

      <div class="specs-blocks">
        <div class="spec-block cpu-block">
          <div class="spec-icon-container">🧠</div>
          <div class="spec-content">
            <h3 class="spec-title">处理器</h3>
            <div class="spec-model">AMD 9950X</div>
            <div class="spec-features">
              <div class="feature-tag">8 核</div>
              <div class="feature-tag">高性能</div>
              <div class="feature-tag">专业级</div>
            </div>
            <p class="spec-desc">强大的多线程处理器，让服务器能够同时处理玩家请求，确保即使在高峰期也能流畅运行。</p>
          </div>
        </div>

        <div class="spec-block ram-block">
          <div class="spec-icon-container">💾</div>
          <div class="spec-content">
            <h3 class="spec-title">内存</h3>
            <div class="spec-model">24GB 6000MHz</div>
            <div class="spec-features">
              <div class="feature-tag">6000MHz</div>
              <div class="feature-tag">大容量</div>
              <div class="feature-tag">高速</div>
            </div>
            <p class="spec-desc">大容量高速内存，为服务器提供充足的运行空间，确保地图加载迅速，并支持更多玩家同时在线。</p>
          </div>
        </div>

        <div class="spec-block storage-block">
          <div class="spec-icon-container">💿</div>
          <div class="spec-content">
            <h3 class="spec-title">存储</h3>
            <div class="spec-model">SSD 7000MB/s</div>
            <div class="spec-features">
              <div class="feature-tag">7000MB/s</div>
              <div class="feature-tag">高速SSD</div>
              <div class="feature-tag">超低延迟</div>
            </div>
            <p class="spec-desc">高速固态硬盘，提供极速的数据读写能力，让世界生成、区块加载和玩家数据存取都能瞬间完成。</p>
          </div>
        </div>

        <div class="spec-block network-block">
          <div class="spec-icon-container">🌐</div>
          <div class="spec-content">
            <h3 class="spec-title">网络</h3>
            <div class="spec-model">50MB 专线</div>
            <div class="spec-features">
              <div class="feature-tag">多线接入</div>
              <div class="feature-tag">全球加速</div>
              <div class="feature-tag">低延迟</div>
            </div>
            <p class="spec-desc">高速稳定的网络连接，确保你的游戏体验没有卡顿和延迟，支持玩家流畅连接。</p>
          </div>
        </div>
      </div>

      <div class="specs-footer">
        <div class="specs-badge"><span>🛡</span><span>99.9% 可用性保证</span></div>
        <div class="specs-badge"><span>⚡</span><span>高性能优化</span></div>
        <div class="specs-badge"><span>🔒</span><span>DDoS 防护</span></div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="server-info">
        <h3>如何加入服务器</h3>
        <ul>
          <li>先加入 QQ 群，获取服务器地址和申请说明。</li>
          <li>请使用正版 Minecraft 客户端。</li>
          <li>禁止使用外挂、脚本或作弊客户端。</li>
          <li>禁止恶意破坏他人建筑和公共区域。</li>
          <li>如有问题请联系管理员处理。</li>
        </ul>
        <div class="hero-buttons">
          <a href="jiao" class="btn btn-primary">申请加入</a>
        </div>
      </div>
    </div>
  </section>

<?php
$extra_js = <<<'JS'
window.addEventListener('scroll', () => {
      const header = document.querySelector('header');
      header.classList.toggle('scrolled', window.scrollY > 50);
    });

    function toggleMenu() {
      const nav = document.getElementById('main-nav');
      const button = document.querySelector('.mobile-menu-btn');
      const isActive = nav.classList.toggle('active');
      button.setAttribute('aria-expanded', isActive ? 'true' : 'false');
    }

    document.querySelectorAll('#main-nav a').forEach(link => {
      link.addEventListener('click', () => {
        if (window.innerWidth <= 900) {
          const nav = document.getElementById('main-nav');
          const button = document.querySelector('.mobile-menu-btn');
          nav.classList.remove('active');
          button.setAttribute('aria-expanded', 'false');
        }
      });
    });

    function updateUptime() {
      const startDate = new Date('2020-07-04T00:00:00+08:00');
      const now = new Date();
      const diff = now - startDate;
      const days = Math.floor(diff / (1000 * 60 * 60 * 24));
      const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((diff % (1000 * 60)) / 1000);

      document.getElementById('uptime').textContent = `LuckyClover 已运行 ${days} 天 ${hours} 小时 ${minutes} 分 ${seconds} 秒`;
      document.getElementById('days').textContent = days;
    }

    async function updateServerStatus() {
      try {
         const response = await fetch(`api/server-status.php?slug=bedrock&_=${Date.now()}`, { cache: 'no-store' });
        const data = await response.json();

        if (data.status === 'online') {
          document.getElementById('online').textContent = `${data.players.online}/${data.players.max}`;
          document.getElementById('version').textContent = data.version || '--';
        } else {
          document.getElementById('online').textContent = '离线';
          document.getElementById('version').textContent = '--';
        }
      } catch (error) {
        document.getElementById('online').textContent = '--';
        document.getElementById('version').textContent = '--';
      }
    }

    async function updateServerStatusJava() {
      try {
         const response = await fetch(`api/server-status.php?slug=java&_=${Date.now()}`, { cache: 'no-store' });
        const data = await response.json();

        if (data.status === 'online') {
          document.getElementById('online-java').textContent = `${data.players.online}/${data.players.max}`;
          document.getElementById('version-java').textContent = data.version || '--';
        } else {
          document.getElementById('online-java').textContent = '离线';
          document.getElementById('version-java').textContent = '--';
        }
      } catch (error) {
        document.getElementById('online-java').textContent = '--';
        document.getElementById('version-java').textContent = '--';
      }
    }

    function updateUptimeJava() {
      const startDateJava = new Date('2026-06-02T00:00:00+08:00');
      const now = new Date();
      const diff = now - startDateJava;
      const daysJava = Math.floor(diff / (1000 * 60 * 60 * 24));
      document.getElementById('days-java').textContent = daysJava;
    }

    async function updateServerStatusSurvival() {
      try {
         const response = await fetch(`api/server-status.php?slug=survival&_=${Date.now()}`, { cache: 'no-store' });
        const data = await response.json();

        if (data.status === 'online') {
          document.getElementById('online-survival').textContent = `${data.players.online}/${data.players.max}`;
          document.getElementById('version-survival').textContent = data.version || '--';
          document.getElementById('status-survival').textContent = '在线';
        } else {
          document.getElementById('online-survival').textContent = '离线';
          document.getElementById('version-survival').textContent = '--';
          document.getElementById('status-survival').textContent = '离线';
        }
      } catch (error) {
        document.getElementById('online-survival').textContent = '--';
        document.getElementById('version-survival').textContent = '--';
        document.getElementById('status-survival').textContent = '查询失败';
      }
    }

    setInterval(updateUptime, 1000);
    setInterval(updateUptimeJava, 1000);
    setInterval(updateServerStatus, 30000);
    setInterval(updateServerStatusJava, 30000);
    setInterval(updateServerStatusSurvival, 30000);

    async function updateServerStatusTest() {
      try {
         const response = await fetch(`api/server-status.php?slug=java_survival&_=${Date.now()}`, { cache: 'no-store' });
        const data = await response.json();

        if (data.status === 'online') {
          document.getElementById('online-test').textContent = `${data.players.online}/${data.players.max}`;
          document.getElementById('version-test').textContent = data.version || '--';
          document.getElementById('status-test').textContent = '在线';
        } else {
          document.getElementById('online-test').textContent = '离线';
          document.getElementById('version-test').textContent = '--';
          document.getElementById('status-test').textContent = '离线';
        }
      } catch (error) {
        document.getElementById('online-test').textContent = '--';
        document.getElementById('version-test').textContent = '--';
        document.getElementById('status-test').textContent = '查询失败';
      }
    }

    setInterval(updateServerStatusTest, 30000);
    updateUptime();
    updateUptimeJava();
    updateServerStatus();
    updateServerStatusJava();
    updateServerStatusSurvival();
    updateServerStatusTest();
JS;
require __DIR__ . '/includes/footer.php';
?>
