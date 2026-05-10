<?php require_once 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conquerer — Built for Speed &amp; Trust</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@400;500&family=DM+Sans:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #080c10;
            --bg2: #0e1419;
            --bg3: #141c24;
            --surface: #1a2332;
            --border: rgba(255,255,255,0.07);
            --border-lit: rgba(255,255,255,0.14);
            --accent: #00e5a0;
            --accent2: #0090ff;
            --accent-dim: rgba(0,229,160,0.12);
            --text: #e8edf3;
            --muted: #6b7d8f;
            --faint: #3a4a5a;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ─── GRID BACKGROUND ─── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(0,229,160,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,229,160,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            pointer-events: none;
            z-index: 0;
        }

        /* ─── GLOW ─── */
        .glow-orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
            z-index: 0;
        }
        .glow-orb-1 {
            width: 500px; height: 500px;
            background: rgba(0,229,160,0.06);
            top: -150px; right: -100px;
        }
        .glow-orb-2 {
            width: 400px; height: 400px;
            background: rgba(0,144,255,0.05);
            bottom: 10%; left: -100px;
        }

        /* ─── LAYOUT ─── */
        .wrapper {
            position: relative;
            z-index: 1;
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* ─── NAV ─── */
        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(8,12,16,0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.1rem 2rem;
            max-width: 1100px;
            margin: 0 auto;
        }
        .nav-logo {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
            font-size: 1.3rem;
            letter-spacing: -0.02em;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .nav-logo span {
            color: var(--accent);
        }
        .logo-icon {
            width: 28px; height: 28px;
            background: var(--accent);
            border-radius: 6px;
            display: flex; align-items: center; justify-content: center;
        }
        .logo-icon svg { width: 16px; height: 16px; }
        .nav-badge {
            font-family: 'DM Mono', monospace;
            font-size: 0.7rem;
            color: var(--accent);
            background: var(--accent-dim);
            border: 1px solid rgba(0,229,160,0.2);
            padding: 0.2rem 0.6rem;
            border-radius: 20px;
            letter-spacing: 0.06em;
        }

        /* ─── HERO ─── */
        .hero {
            padding: 7rem 0 5rem;
            text-align: center;
            position: relative;
        }
        .hero-eyebrow {
            font-family: 'DM Mono', monospace;
            font-size: 0.75rem;
            letter-spacing: 0.18em;
            color: var(--accent);
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .hero-eyebrow::before, .hero-eyebrow::after {
            content: '';
            display: inline-block;
            width: 28px; height: 1px;
            background: var(--accent);
            opacity: 0.5;
        }
        h1 {
            font-family: 'Syne', sans-serif;
            font-size: clamp(3rem, 7vw, 5.5rem);
            font-weight: 800;
            line-height: 1.0;
            letter-spacing: -0.03em;
            margin-bottom: 1.5rem;
        }
        h1 .accent { color: var(--accent); }
        .hero-sub {
            font-size: 1.15rem;
            color: var(--muted);
            max-width: 480px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
        }
        .hero-domain {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-family: 'DM Mono', monospace;
            font-size: 0.85rem;
            color: var(--muted);
            background: var(--surface);
            border: 1px solid var(--border-lit);
            padding: 0.55rem 1.2rem;
            border-radius: 30px;
        }
        .hero-domain .dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--accent);
            animation: pulse 2s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        /* ─── STATS ─── */
        .stats-bar {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            margin: 4rem 0;
        }
        .stat {
            background: var(--bg2);
            padding: 2rem 1.5rem;
            text-align: center;
        }
        .stat-num {
            font-family: 'Syne', sans-serif;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--accent);
            display: block;
            margin-bottom: 0.25rem;
        }
        .stat-label {
            font-size: 0.8rem;
            color: var(--muted);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            font-family: 'DM Mono', monospace;
        }

        /* ─── SECTION TITLE ─── */
        .section-label {
            font-family: 'DM Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 0.5rem;
        }
        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 0.5rem;
        }
        .section-desc {
            color: var(--muted);
            font-size: 0.95rem;
            margin-bottom: 2.5rem;
        }

        /* ─── TEAM TABLE ─── */
        .table-wrapper {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 5rem;
        }
        .table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.25rem 1.75rem;
            border-bottom: 1px solid var(--border);
        }
        .table-title {
            font-family: 'Syne', sans-serif;
            font-weight: 600;
            font-size: 0.95rem;
        }
        .member-count {
            font-family: 'DM Mono', monospace;
            font-size: 0.75rem;
            color: var(--accent);
            background: var(--accent-dim);
            border: 1px solid rgba(0,229,160,0.15);
            padding: 0.2rem 0.7rem;
            border-radius: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        thead th {
            text-align: left;
            padding: 0.85rem 1.75rem;
            font-family: 'DM Mono', monospace;
            font-size: 0.72rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            background: var(--bg3);
            border-bottom: 1px solid var(--border);
            font-weight: 400;
        }
        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s ease;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: rgba(255,255,255,0.025); }
        tbody td {
            padding: 1.1rem 1.75rem;
            font-size: 0.9rem;
            color: var(--text);
            vertical-align: middle;
        }

        /* avatar */
        .member-cell { display: flex; align-items: center; gap: 0.85rem; }
        .avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--surface);
            border: 1px solid var(--border-lit);
            display: flex; align-items: center; justify-content: center;
            font-family: 'Syne', sans-serif;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--accent);
            flex-shrink: 0;
        }
        .member-name { font-weight: 500; }

        /* reg number */
        .reg-mono {
            font-family: 'DM Mono', monospace;
            font-size: 0.82rem;
            color: var(--muted);
        }

        /* role badge */
        .role-badge {
            display: inline-block;
            font-size: 0.73rem;
            font-family: 'DM Mono', monospace;
            padding: 0.25rem 0.7rem;
            border-radius: 20px;
            border: 1px solid;
            white-space: nowrap;
        }
        .role-lead    { color: #00e5a0; background: rgba(0,229,160,0.08); border-color: rgba(0,229,160,0.2); }
        .role-dev     { color: #0090ff; background: rgba(0,144,255,0.08); border-color: rgba(0,144,255,0.2); }
        .role-design  { color: #c084fc; background: rgba(192,132,252,0.08); border-color: rgba(192,132,252,0.2); }
        .role-ops     { color: #fb923c; background: rgba(251,146,60,0.08); border-color: rgba(251,146,60,0.2); }
        .role-default { color: var(--muted); background: rgba(107,125,143,0.08); border-color: rgba(107,125,143,0.2); }

        /* subdomain */
        .subdomain-link {
            font-family: 'DM Mono', monospace;
            font-size: 0.8rem;
            color: var(--accent2);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        .subdomain-link:hover { text-decoration: underline; }
        .subdomain-link svg { width: 12px; height: 12px; opacity: 0.6; }

        /* ─── FOOTER ─── */
        footer {
            border-top: 1px solid var(--border);
            padding: 2rem;
            text-align: center;
        }
        .footer-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .footer-copy {
            font-size: 0.8rem;
            color: var(--faint);
            font-family: 'DM Mono', monospace;
        }
        .footer-slogan {
            font-size: 0.8rem;
            color: var(--muted);
            font-style: italic;
        }

        @media (max-width: 640px) {
            .stats-bar { grid-template-columns: 1fr; }
            h1 { font-size: 2.8rem; }
            thead th:nth-child(2), tbody td:nth-child(2) { display: none; }
            .footer-inner { justify-content: center; }
        }
    </style>
</head>
<body>

<div class="glow-orb glow-orb-1"></div>
<div class="glow-orb glow-orb-2"></div>

<!-- NAV -->
<nav>
    <div class="nav-inner">
        <div class="nav-logo">
            <div class="logo-icon">
                <svg viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 2L14 5.5V10.5L8 14L2 10.5V5.5L8 2Z" fill="#080c10"/>
                    <path d="M8 5L11 6.75V10.25L8 12L5 10.25V6.75L8 5Z" fill="#00e5a0" opacity="0.8"/>
                </svg>
            </div>
            Conquer<span>er</span>
        </div>
        <span class="nav-badge">conquerer.org</span>
    </div>
</nav>

<!-- HERO -->
<div class="wrapper">
    <section class="hero">
        <div class="hero-eyebrow">Web Hosting Reimagined</div>
        <h1>We host.<br>You <span class="accent">conquer.</span></h1>
        <p class="hero-sub">Enterprise-grade hosting infrastructure built for developers who refuse to compromise on speed, reliability, or trust.</p>
        <div class="hero-domain">
            <span class="dot"></span>
            conquerer.org &nbsp;·&nbsp; Live
        </div>
    </section>

    <!-- STATS -->
    <div class="stats-bar">
        <div class="stat">
            <span class="stat-num">99.9%</span>
            <span class="stat-label">Uptime SLA</span>
        </div>
        <div class="stat">
            <span class="stat-num">&lt;50ms</span>
            <span class="stat-label">Avg Response</span>
        </div>
        <div class="stat">
            <span class="stat-num">24/7</span>
            <span class="stat-label">Support</span>
        </div>
    </div>

    <!-- TEAM -->
    <div class="section-label">The People</div>
    <h2 class="section-title">Our Team</h2>
    <p class="section-desc">The engineers and builders powering Conquerer's infrastructure.</p>

    <div class="table-wrapper">
        <div class="table-header">
            <span class="table-title">Team Members</span>
            <span class="member-count" id="member-count">
                <?php
                $count = $pdo->query("SELECT COUNT(*) FROM members")->fetchColumn();
                echo $count . " member" . ($count != 1 ? "s" : "");
                ?>
            </span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Reg. Number</th>
                    <th>Role</th>
                    <th>Subdomain</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query("SELECT * FROM members ORDER BY id");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                    // Generate initials from name
                    $parts = explode(' ', trim($row['name']));
                    $initials = '';
                    foreach (array_slice($parts, 0, 2) as $p) {
                        $initials .= strtoupper(substr($p, 0, 1));
                    }

                    // Role badge class
                    $role_lower = strtolower($row['role']);
                    if (str_contains($role_lower, 'lead') || str_contains($role_lower, 'manager') || str_contains($role_lower, 'head')) {
                        $badge = 'role-lead';
                    } elseif (str_contains($role_lower, 'dev') || str_contains($role_lower, 'engineer') || str_contains($role_lower, 'backend') || str_contains($role_lower, 'frontend')) {
                        $badge = 'role-dev';
                    } elseif (str_contains($role_lower, 'design') || str_contains($role_lower, 'ui') || str_contains($role_lower, 'ux')) {
                        $badge = 'role-design';
                    } elseif (str_contains($role_lower, 'ops') || str_contains($role_lower, 'infra') || str_contains($role_lower, 'devops') || str_contains($role_lower, 'sysadmin')) {
                        $badge = 'role-ops';
                    } else {
                        $badge = 'role-default';
                    }
                ?>
                <tr>
                    <td>
                        <div class="member-cell">
                            <div class="avatar"><?= htmlspecialchars($initials) ?></div>
                            <span class="member-name"><?= htmlspecialchars($row['name']) ?></span>
                        </div>
                    </td>
                    <td><span class="reg-mono"><?= htmlspecialchars($row['registration_number']) ?></span></td>
                    <td><span class="role-badge <?= $badge ?>"><?= htmlspecialchars($row['role']) ?></span></td>
                    <td>
                        <a class="subdomain-link" href="https://<?= htmlspecialchars($row['subdomain']) ?>.conquerer.org" target="_blank">
                            <?= htmlspecialchars($row['subdomain']) ?>.conquerer.org
                            <svg viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 10L10 2M10 2H5M10 2V7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- FOOTER -->
<footer>
    <div class="footer-inner">
        <span class="footer-copy">© <?= date('Y') ?> Conquerer · conquerer.org</span>
        <span class="footer-slogan">"Built for speed and trust"</span>
    </div>
</footer>

</body>
</html>
