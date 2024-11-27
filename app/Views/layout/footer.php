<?=str_contains($_SERVER['REQUEST_URI'], '/home') ? view('pages/home/filterPanel') : ''?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
	const base_url_img = '<?=base_url('assets/imgs/')?>';
</script>
<?=str_contains($_SERVER['REQUEST_URI'], '/home') ? '<script type="module" src="/assets/scripts/home/home.js"></script>': '' ?>
</html>