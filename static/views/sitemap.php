<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo site_url(); ?></loc>
        <lastmod>2026-05-12</lastmod>
    </url>
    <url>
        <loc><?php echo page_url('docs'); ?></loc>
        <lastmod>2026-05-12</lastmod>
    </url>

    <?php foreach ($docFiles as $doc): ?>
        <url>
            <loc><?php echo $doc['url']; ?></loc>
            <lastmod><?php echo $doc['date']; ?></lastmod>
        </url>
    <?php endforeach; ?>
</urlset>