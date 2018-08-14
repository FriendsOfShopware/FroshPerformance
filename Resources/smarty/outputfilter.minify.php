<?php

function smarty_outputfilter_minify($output)
{
    if (strpos($output, '<head>') == -1) {
        return $output;
    }
    /*
     * Uses Alan Moore's regexp:
     * http://stackoverflow.com/questions/5312349/minifying-final-html-output-using-regular-expressions-with-codeigniter
     *
     * the following code to minify the HTML output
     * (it leaves whitespace within `<pre>` and `<textarea>` tags untouched)
     */
    return preg_replace('#(?ix)(?>[^\S ]\s*|\s{2,})(?=(?:(?:[^<]++|<(?!/?(?:textarea|pre)\b))*+)(?:<(?>textarea|pre)\b|\z))#', ' ', $output);
}
