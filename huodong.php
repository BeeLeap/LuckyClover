<?php
/**
 * huodong.php
 */
$page_title = "活动 - LuckyClover";
$page_desc = "查看 LuckyClover 最新活动公告，了解活动安排、报名方式与历史活动记录。";
$active_nav = "huodong.php";
$extra_css = <<<CSS
.page-wrap {
      max-width: 980px;
      margin: 0 auto;
      padding: 120px 24px 72px;
    }

    .hero-card,
    .announce-item {
      border: 1px solid rgba(255, 159, 10, 0.34);
      background: transparent;
      box-shadow: none;
    }

    .hero-card {
      border-radius: 30px;
      padding: clamp(28px, 5vw, 46px);
      text-align: center;
    }

    .hero-card h1 {
      margin: 18px 0 14px;
      font-size: clamp(2.2rem, 6vw, 4rem);
      letter-spacing: -0.05em;
    }

    .hero-card p {
      max-width: 680px;
      margin: 0 auto;
      color: var(--text-secondary);
      font-size: 1.08rem;
      line-height: 1.85;
    }

    .tag-row {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 10px;
    }

    .tag {
      padding: 8px 13px;
      border: 1px solid rgba(255, 159, 10, 0.34);
      border-radius: 999px;
      background: rgba(255, 159, 10, 0.08);
      color: var(--accent-secondary);
      font-size: 0.88rem;
      font-weight: 700;
    }

    .announce-grid {
      display: grid;
      gap: 18px;
      margin-top: 24px;
    }

    .announce-item {
      border-radius: 22px;
      padding: 24px;
    }

    .announce-item h2 {
      margin: 0 0 10px;
      font-size: 1.25rem;
    }

    .announce-item p {
      margin: 0;
      color: var(--text-secondary);
      line-height: 1.85;
    }

    .event-detail {
      display: grid;
      gap: 16px;
      margin-top: 18px;
    }

    .event-detail h3 {
      margin: 0 0 8px;
      color: var(--accent-secondary);
      font-size: 1.05rem;
    }

    .event-detail ul {
      margin: 0;
      padding-left: 1.2rem;
      color: var(--text-secondary);
      line-height: 1.85;
    }

    .event-detail li {
      margin: 4px 0;
    }

    .reward-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 12px;
      margin-top: 12px;
    }

    .reward-card {
      border: 2px solid #111;
      background: rgba(10, 21, 16, 0.72);
      box-shadow: 3px 3px 0 rgba(0, 0, 0, 0.32);
      padding: 14px;
    }

    .reward-card strong {
      display: block;
      margin-bottom: 6px;
      color: var(--accent-secondary);
    }

    .signup-link {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-top: 12px;
      padding: 12px 18px;
      border: 3px solid #111;
      background: var(--accent-gradient);
      box-shadow: 4px 4px 0 rgba(0, 0, 0, 0.35);
      color: #102018;
      font-weight: 900;
    }

    .signup-link:hover {
      transform: translate(2px, 2px);
      box-shadow: 2px 2px 0 rgba(0, 0, 0, 0.35);
    }

    .history-detail {
      display: grid;
      gap: 16px;
      margin-top: 18px;
    }

    .history-detail h3 {
      margin: 0 0 6px;
      color: var(--text-primary);
      font-size: 1rem;
    }

    .section-title {
      margin: 56px 0 18px;
      text-align: center;
      font-size: clamp(1.7rem, 4vw, 2.4rem);
    }

    .empty-state {
      margin-top: 24px;
      border-color: rgba(132, 140, 255, 0.38);
    }

    .history-list {
      opacity: 0.82;
    }

    @media (max-width: 768px) {
      .page-wrap {
        padding: 96px 18px 56px;
      }

      .hero-card,
      .announce-item {
        border-radius: 20px;
      }
    }
CSS;
require __DIR__ . '/includes/header.php';
?>

<main class="page-wrap">
    <section class="hero-card">
      <div class="tag-row">
        <span class="tag">当前活动</span>
        <span class="tag">LuckyCup</span>
        <span class="tag">刀战 PVP</span>
      </div>
      <h1>首届 LuckyCup 刀战 PVP 大赛</h1>
      <p>报名现已开启。荣耀属于最强者，期待与你在竞技场相见！</p>
    </section>

    <section class="announce-grid">
      <article class="announce-item">
        <h2>LuckyClover 服务器首届 LuckyCup 刀战 PVP 大赛报名开启！</h2>
        <p>公平装备、双败淘汰、冠军留名。准备好证明自己的刀战实力了吗？</p>

        <div class="event-detail">
          <div>
            <h3>活动时间</h3>
            <ul>
              <li>第一场：待定，预计 2026 年 ** 月 ** 日 19 时 30 分。</li>
              <li>第二场：待定，具体时间另行通知。</li>
              <li>每场大约 1 小时。</li>
            </ul>
          </div>

          <div>
            <h3>参与方式</h3>
            <ul>
              <li>在服务器中输入 /huodong，即可传送至活动服务器。</li>
            </ul>
          </div>

          <div>
            <h3>比赛装备</h3>
            <ul>
              <li>所有工具均附魔经验修补。</li>
              <li>下界合金头盔、胸甲、护腿、靴子均附魔「保护 IV」。</li>
              <li>下界合金剑、下界合金斧均附魔「锋利 III」。</li>
              <li>弓附魔「力量 III」。</li>
              <li>装备以群内公告配图为准。</li>
            </ul>
          </div>

          <div>
            <h3>报名方式</h3>
            <ul>
              <li>填写报名表即可，也可以查看群待办。</li>
              <li>报名截止：活动开始前 15 分钟。</li>
            </ul>
            <a class="signup-link" href="https://docs.qq.com/form/page/sequence/DR0FnU0FDVVVneVJu" target="_blank" rel="noopener noreferrer">打开第一场报名表</a>
          </div>

          <div>
            <h3>比赛规则</h3>
            <ul>
              <li>双败淘汰赛，每位玩家有两次机会。</li>
              <li>全员统一装备，公平竞技。</li>
              <li>决赛采用三局两胜。</li>
            </ul>
          </div>

          <div>
            <h3>活动奖励（每场）</h3>
            <div class="reward-grid">
              <div class="reward-card"><strong>冠军</strong>50000 金币 +「LuckyCup 冠军」限定称号 + 冠军榜永久留名</div>
              <div class="reward-card"><strong>亚军</strong>25000 金币</div>
              <div class="reward-card"><strong>季军</strong>10000 金币</div>
              <div class="reward-card"><strong>参与奖</strong>3000 金币</div>
            </div>
          </div>

          <div>
            <h3>注意事项</h3>
            <ul>
              <li>请提前到场，并听从管理员安排。</li>
              <li>严禁作弊、开挂、恶意利用漏洞等违规行为。</li>
              <li>如遇服务器异常，本局将重新开始。</li>
              <li>本活动最终解释权归 LuckyClover BE 管理组所有。</li>
            </ul>
          </div>
        </div>
      </article>
    </section>

    <h2 class="section-title">历史活动</h2>
    <section class="announce-grid history-list" aria-label="历史活动">
      <article class="announce-item">
        <h2>劳动节活动公告</h2>
        <p>LuckyClover 曾开放劳动节特别活动，包含建筑挑战、登录奖励与节日玩法说明。</p>

        <div class="history-detail">
          <div>
            <h3>建筑大赛</h3>
            <p>曾计划在 5 月举办建筑活动，玩家可通过主服务器内的 /huodong 指令加入活动服务器。</p>
          </div>
          <div>
            <h3>登录奖励上线</h3>
            <p>活动期间每日登录可领取 500 资产奖励，鼓励玩家在节日期间回到服务器一起游玩。</p>
          </div>
          <div>
            <h3>注意事项</h3>
            <p>活动要求玩家在指定区域建造，禁止抄袭或恶意破坏，共同维护公平友好的活动环境。</p>
          </div>
        </div>
      </article>
    </section>
  </main>

<?php
$extra_js = <<<JS
function toggleMenu() {
      const nav = document.getElementById('main-nav');
      const button = document.querySelector('.mobile-menu-btn');
      const isActive = nav.classList.toggle('active');
      button.setAttribute('aria-expanded', isActive ? 'true' : 'false');
    }

    document.querySelectorAll('#main-nav a').forEach(link => {
      link.addEventListener('click', () => {
        if (window.innerWidth <= 768) {
          const nav = document.getElementById('main-nav');
          const button = document.querySelector('.mobile-menu-btn');
          nav.classList.remove('active');
          button.setAttribute('aria-expanded', 'false');
        }
      });
    });
JS;
require __DIR__ . '/includes/footer.php';
?>