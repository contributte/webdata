<?php declare(strict_types = 1);

use Milo\Github\Api;

require __DIR__ . '/../vendor/autoload.php';

$pages = [1];
$repos = [];

$api = new Api();

foreach ($pages as $page) {
	$response = $api->get('orgs/contributte/repos?per_page=100&page=' . $page);
	$content = json_decode($response->getContent(), true);
	$content = array_map(function ($repo) {
		return [
			'org' => 'contributte',
			'name' => $repo['name'],
		];
	}, $content);
	$repos = array_merge($repos, $content);
}

file_put_contents(__DIR__ . '/../data/repos-v1.json', json_encode($repos, JSON_PRETTY_PRINT));
