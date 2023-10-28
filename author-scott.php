<?php
defined('ABSPATH') || exit;

get_header(); ?>
<section id="primary">
	<main id="content" role="main" <?php semantic_main_class(); ?>>
		<header class="clearfix page-header author vcard h-card pb-3 mb-3" itemprop="author" itemscope itemtype="http://schema.org/Person">
			<h1 class="page-title display-4 border-bottom mb-3 border-secondary-subtle">About the Author</h1>
			<div class="d-flex">
				<div><?php echo get_avatar(get_the_author_meta('ID'), 150); ?></div>
				<div class="author-note note p-note" itemprop="description">
					<p><span class="fn p-fn n p-name text-body-emphasis text-shadow">Scott Killen</span> is a multifaceted individual with a passion for both the spiritual and technological realms. By day, he's a <a class="p-name p-org u-url link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover" href="https://killencpa.com/" title="Killen & Associates, CPAs, PA">Certified Public Accountant</a>, managing numbers and ensuring financial order. On Sundays, he steps into the role of a teacher and preacher, sharing the wisdom and teachings of the Bible with <a class="p-name p-org u-url link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover" href="https://edistochurch.org/" title="Edisto Church of Christ">the congregation</a> though bible studies and sermons.</p>
					<p>Beyond his professional life, he's a software developer, constantly diving into the ever-evolving world of technology. He also has a deep love for learning, always seeking out obscure knowledge to satisfy his curiosity. When not immersed in numbers or code, you'll find him enjoying quality time with his wife or pursuing his love for writing, including poetry. He enjoys taking nature photographs and has a love for carpentry, building and crafting with his own hands. Here where faith, fun, and technology coexist, he writes about the things that interest him.</p>
				</div>
			</div>
		</header>
	</main><!-- #content -->
</section><!-- #primary -->
<?php
get_footer();
