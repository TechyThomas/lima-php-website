<aside class="docs-sidebar-wrap">
    <div class="docs-sidebar">
        <div class="docs-sidebar__titlebar"><?php echo lucide_icon('file-text'); ?><span>Documentation</span></div>
        <div class="docs-sidebar__content">
            <nav aria-label="Documentation pages">
                <?php foreach ($data['docs'] as $docSlug => $doc): ?>
                    <a class="docs-nav-link <?php if (!empty($data['current_doc']) && $docSlug == $data['current_doc']) echo 'is-active'; ?>" href="/docs/<?php echo $docSlug; ?>">
                        <span><?php echo $doc['title']; ?></span>
                        <?php echo lucide_icon('chevron-right'); ?>
                    </a>
                <?php endforeach; ?>
            </nav>
            <a class="button button-primary button-block" href="/">
                <?php echo lucide_icon('house'); ?><span>Back to homepage</span>
            </a>
        </div>
    </div>
</aside>