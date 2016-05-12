<?php
/*
  - 空ディレクトリの構造体を作成してzipファイルとしてダウンロードさせるClass
  - zipファイルを一度ファイルとして保存する必要はどうしてもありそうだ。
*/

class ZipStructure{

	public function __construct() {
	}



	public function run($name,$dirArray){
		$zipName = $name.".zip";

		$zip = new ZipArchive;
		if ($zip->open($zipName, ZipArchive::CREATE) === true) {
			foreach($dirArray as $dir){
				$zip->addEmptyDir($dir);
			}
			$zip->close();
			$this->httpZipOutput($zipName);
			unlink($zipName);
		}


	}



	private function httpZipOutput($zipName){
		if(! $zipName){
			header('HTTP', true, 500);
			return false;
		}else{
			header('Content-Type: application/zip');
			header("Content-Disposition: attachment; filename=" . $zipName);
			readfile($zipName);
			return true;
		}
	}


}
