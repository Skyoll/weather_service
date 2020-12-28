<?

use Bitrix\Main\Loader;

Loader::includeModule('ws.projectsettings');

$initToolsModule = function () {
	if (!\Bitrix\Main\Loader::includeModule("ws.tools")) {
		return;
	}
	$module = \WS\Tools\Module::getInstance();
	$module->config(include __DIR__ . DIRECTORY_SEPARATOR . ".ws_tools_config.php");
	$module->config(include __DIR__ . DIRECTORY_SEPARATOR . "config.php");
	if (file_exists(__DIR__ . "/include/constant.php"))
		require_once __DIR__ . "/include/constant.php";
	if (file_exists(__DIR__ . "/include/eventHandlers.php"))
		require_once __DIR__ . "/include/eventHandlers.php";
};
$initToolsModule();