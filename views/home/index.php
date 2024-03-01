<?php include_once __DIR__ . '/../_base.php'; ?>

<div id="root">
    <div>
        <header class="header">
            <div class="header__container">
                <nav class="header__nav">
                    <a href="/" class="header__logo">
                        <img src="/svg/IMPINCODE_BLACK.svg" alt="logo" />
                    </a>
                    
                    <div id="lang">
                        <button>
                            <span>Langue du site <?= htmlspecialchars(strtoupper($lang)) ?></span>
                            <img src='https://d35aaqx5ub95lt.cloudfront.net/images/splash/c6eae48dd48246c89e415b89f9e55282.svg' alt />
                        </button>
                    </div>
                </nav>
            </div>
            <div></div>
            <div></div>
        </header>
    </div>
</div>



<?php include_once __DIR__ . '/../_footer.php'; ?>