<?php
/**
 * Element for recursively rendering UTM tree
 * 
 * Variables:
 * - $items: Array of tree items
 * - $level: Current depth level (default 0)
 */

if (!isset($level)) {
    $level = 0;
}

foreach ($items as $item):
    $utm = $item['UtmDatum'];
    $children = isset($item['children']) ? $item['children'] : array();
    
    // Build UTM breadcrumb
    $breadcrumb = array();
    
    if (!empty($utm['source'])) {
        $breadcrumb[] = 'Source: ' . h($utm['source']);
    }
    if (!empty($utm['medium'])) {
        $breadcrumb[] = 'Medium: ' . h($utm['medium']);
    }
    if (!empty($utm['campaign'])) {
        $breadcrumb[] = 'Campaign: ' . h($utm['campaign']);
    }
    if (!empty($utm['content'])) {
        $breadcrumb[] = 'Content: ' . h($utm['content']);
    }
    if (!empty($utm['term'])) {
        $breadcrumb[] = 'Term: ' . h($utm['term']);
    }
    ?>
    
    <div class="utm-tree-item utm-level-<?php echo $level; ?>">
        <span><?php echo implode(' > ', $breadcrumb); ?></span>
    </div>
    
    <?php
    if (!empty($children)):
        echo $this->element('utm_tree', array(
            'items' => $children,
            'level' => $level + 1
        ));
    endif;
endforeach;
?>