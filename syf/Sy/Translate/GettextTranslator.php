<?php
namespace Sy\Translate;

class GettextTranslator extends Translator implements ITranslator {

	public function loadTranslationData() {

		$language = $this->getTranslationLang();
		$filename = $this->getTranslationDir() . '/' . $language . '.mo';
		$data = array();

		if (file_exists($filename)) {
			$file = @fopen($filename, 'rb');

			if (!$file) {
				throw new \Exception($filename . ' not found');
			}

			if (filesize($filename) < 10) {
				@fclose($file);
				throw new \Exception($filename . ' is not a MO file');
			}

			// get Endian
			$input = $this->readMOData($file, 1);

			if (strtolower(substr(dechex($input[1]), -8)) == "950412de") {
				$bigEndian = false;
			} else if (strtolower(substr(dechex($input[1]), -8)) == "de120495") {
				$bigEndian = true;
			} else {
				@fclose($file);
			}

			// read revision
			$input = $this->readMOData($file, 1, $bigEndian);

			// number of bytes
			$input = $this->readMOData($file, 1, $bigEndian);
			$total = $input[1];

			// number of original strings
			$input = $this->readMOData($file, 1, $bigEndian);
			$OOffset = $input[1];

			// number of translation strings
			$input = $this->readMOData($file, 1, $bigEndian);
			$TOffset = $input[1];

			// fill the original table
			fseek($file, $OOffset);
			$origtemp = $this->readMOData($file, 2 * $total, $bigEndian);
			fseek($file, $TOffset);
			$transtemp = $this->readMOData($file, 2 * $total, $bigEndian);

			for($count = 0; $count < $total; ++$count) {
				if ($origtemp[$count * 2 + 1] != 0) {
					fseek($file, $origtemp[$count * 2 + 2]);
					$original = @fread($file, $origtemp[$count * 2 + 1]);
					$original = explode("\0", $original);
				} else {
					$original[0] = '';
				}

				if ($transtemp[$count * 2 + 1] != 0) {
					fseek($file, $transtemp[$count * 2 + 2]);
					$translate = fread($file, $transtemp[$count * 2 + 1]);
					$translate = explode("\0", $translate);
					if ((count($original) > 1) && (count($translate) > 1)) {
						$data[$locale][$original[0]] = $translate;
						array_shift($original);
						foreach ($original as $orig) {
							$data[$orig] = '';
						}
					} else {
						$data[$original[0]] = $translate[0];
					}
				}
			}

			@fclose($file);
		}


//		putenv('LANG='        . $language . '_FR.utf8');
//		putenv('LANGUAGE='    . $language . '_FR.utf8');
//		putenv('LC_ALL='      . $language . '_FR.utf8');
//		setlocale(LC_ALL      , $language . '_FR.utf8');
//
//		// Set the text domain as 'messages'
//		$domain = $language;
//		bind_textdomain_codeset($domain, 'UTF-8');
//		bindtextdomain($domain, $this->getTranslationDir());
//		textdomain($domain);

		return $data;
	}


	/**
     * Read values from the MO file
     *
     * @param  string  $bytes
     */
    private function readMOData($file, $bytes, $bigEndian = false) {
        if ($bigEndian === false) {
            return unpack('V' . $bytes, fread($file, 4 * $bytes));
        } else {
            return unpack('N' . $bytes, fread($file, 4 * $bytes));
        }
    }

}