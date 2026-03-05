<?php
$this->Html->addCrumb('Statistics', array('action' => 'index'));
$this->Html->addCrumb('UTM Data Tree');
?>

<div class="statistics utm-list">
    <h1>UTM Data Structure</h1>

    <?php if (empty($tree)): ?>
        <p>No UTM data available.</p>
    <?php else: ?>
        <div class="utm-tree">
            <?php echo $this->element('utm_tree', array('items' => $tree)); ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <ul>
                <?php
                // Previous page
                if ($page > 1):
                    echo '<li class="prev">' . 
                        $this->Html->link('« Previous', array(
                            'action' => 'utm_list',
                            '?' => array('page' => $page - 1)
                        )) . '</li>';
                else:
                    echo '<li class="prev disabled"><span>« Previous</span></li>';
                endif;
                
                // Page numbers
                for ($i = 1; $i <= $totalPages; $i++):
                    if ($i === $page):
                        echo '<li class="active"><span>' . $i . '</span></li>';
                    else:
                        echo '<li>' . $this->Html->link($i, array(
                            'action' => 'utm_list',
                            '?' => array('page' => $i)
                        )) . '</li>';
                    endif;
                endfor;
                
                // Next page
                if ($page < $totalPages):
                    echo '<li class="next">' . 
                        $this->Html->link('Next »', array(
                            'action' => 'utm_list',
                            '?' => array('page' => $page + 1)
                        )) . '</li>';
                else:
                    echo '<li class="next disabled"><span>Next »</span></li>';
                endif;
                ?>
            </ul>
        </div>

        <p class="pagination-info">
            Showing page <?php echo $page; ?> of <?php echo $totalPages; ?> 
            (<?php echo $total; ?> total sources)
        </p>
    <?php endif; ?>
</div>

<style>
.utm-tree {
    margin: 20px 0;
    font-family: monospace;
}

.utm-tree-item {
    margin: 5px 0;
    padding: 5px;
    border-left: 2px solid #ddd;
}

.utm-level-0 {
    margin-left: 0;
    font-weight: bold;
    color: #000;
}

.utm-level-1 {
    margin-left: 20px;
    color: #000;
}

.utm-level-2 {
    margin-left: 40px;
    color: #000;
}

.utm-level-3 {
    margin-left: 60px;
    color: #000;
}

.utm-level-4 {
    margin-left: 80px;
    color: #000;
}

.pagination {
    margin-top: 30px;
    text-align: center;
}

.pagination ul {
    display: inline-block;
    list-style: none;
    padding: 0;
}

.pagination li {
    display: inline-block;
    margin: 0 5px;
}

.pagination a, .pagination span {
    padding: 5px 10px;
    border: 1px solid #ddd;
    text-decoration: none;
    color: #0066cc;
}

.pagination a:hover {
    background-color: #f5f5f5;
}

.pagination .active span {
    background-color: #0066cc;
    color: white;
    border-color: #0066cc;
}

.pagination .disabled span {
    color: #ccc;
    cursor: not-allowed;
}
</style>