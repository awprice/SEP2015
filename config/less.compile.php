<?php

	require __DIR__ . '/../modules/less.php/Less.php';

	echo "<pre>Less Compilation.<br>";
    echo "--------------------<br>";

    $less_files = [
        'normal' => "/../less/style.less",
    ];

    $output_files = [
        'normal' => "/../css/style.css",
    ];

    foreach ($less_files as $key => $input) {

        echo "Compiling " . __DIR__ . $input . "...<br>";

        $start = microtime(true);

        try {
            $options = array(
                'compress' => true
            );
            $parser = new Less_Parser($options);
            $parser->parseFile(__DIR__ . $input);
            $css = $parser->getCss();

            $css = "/* Less compiled in " . number_format(microtime(true) - $start, 2) . "s at " . date("r") . " */\r\n\r\n" . $css;

        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }

        echo "Less compiled successfully.<br>";
        echo "Saving output CSS to file...<br>";

        try {
            $outputfile = fopen(__DIR__ . $output_files[$key], "w");
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }

        fwrite($outputfile, $css);
        fclose($outputfile);

        echo "--------------------<br>";

    }

    echo "Done!</pre>";

?>
