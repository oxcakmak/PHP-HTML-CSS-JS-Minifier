<?php
/*
* Special thanks: Stephen Clay <steve@mrclay.org>
*/
function sanitize_output($html){
        $html = preg_replace_callback(
            '/(\\s*)<script(\\b[^>]*?>)([\\s\\S]*?)<\\/script>(\\s*)/i'
            ,''
            ,$html);
        
        $html = preg_replace_callback(
            '/\\s*<style(\\b[^>]*>)([\\s\\S]*?)<\\/style>\\s*/i'
            ,''
            ,$html);
        
        $html = preg_replace_callback(
            '/<!--([\\s\\S]*?)-->/'
            ,''
            ,$html);
        
        $html = preg_replace_callback('/\\s*<pre(\\b[^>]*?>[\\s\\S]*?<\\/pre>)\\s*/i'
            ,''
            ,$html);
        
        $html = preg_replace_callback(
            '/\\s*<textarea(\\b[^>]*?>[\\s\\S]*?<\\/textarea>)\\s*/i'
            ,''
            ,$html);
        
        // @todo take into account attribute values that span multiple lines.
        $html = preg_replace('/^\\s+|\\s+$/m', '', $html);
        
        $html = preg_replace('/\\s+(<\\/?(?:area|base(?:font)?|blockquote|body'
            .'|caption|center|col(?:group)?|dd|dir|div|dl|dt|fieldset|form'
            .'|frame(?:set)?|h[1-6]|head|hr|html|legend|li|link|map|menu|meta'
            .'|ol|opt(?:group|ion)|p|param|t(?:able|body|head|d|h||r|foot|itle)'
            .'|ul)\\b[^>]*>)/i', '$1', $html);
        
        $html = preg_replace(
            '/>(\\s(?:\\s*))?([^<]+)(\\s(?:\s*))?</'
            ,'>$1$2$3<'
            ,$html);
        
        $html = preg_replace('/(<[a-z\\-]+)\\s+([^>]+>)/i', "$1\n$2", $html);

        return $html;
}
ob_start("sanitize_output");
?>
