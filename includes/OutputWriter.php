<?php

require_once('OutputType.php');

class OutputWriter {
    private OutputTypeEnum $outputType;

    public function __construct(OutputTypeEnum $outputType) {
        $this->outputType = $outputType;
    }

    public function setOutputType(OutputTypeEnum $outputType) {
        $this->outputType = $outputType;
    }

    public function write(array $json) {
        $keyRegex = '/([a-z])([A-Z])/';

        $data = '';
        foreach($json as $item) {
            foreach($item as $key => $value) {
                if (empty($key) || empty($value) && $value != 0) continue;
                if ($key == 'key') continue;
    
                $key = preg_replace($keyRegex, '$1 $2', $key);
                
                $data .= ucfirst($key) . ": " . (str_contains($value, 'http') ? $value : (is_bool($value) ? ($value == true ? 'Yes' : 'No') : ucfirst($value))) . "\n";
            }

            $data .= "\n";
        }

        switch($this->outputType) {
            case OutputTypeEnum::console:
                $data = "\n" . trim($data) . "\n";
                echo($data);

                break;
            case OutputTypeEnum::file:
                if (!file_exists('output')) {
                    mkdir('output');
                }

                $file = fopen('output/output.txt', 'w');
                if ($file) {
                    $data = trim($data);

                    if (fwrite($file, $data)) {
                        echo('Done');
                    } else {
                        echo('Couldn\'t write output to file. Please try again or use console output instead.');
                    }
                } else {
                    echo('Couldn\'t open file. Please create one and try again.');
                }

                fclose($file);

                break;
        }
    }
}