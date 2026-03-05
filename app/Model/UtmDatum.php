<?php
class UtmDatum extends AppModel {
    public $name = 'UtmDatum';
    public $actsAs = array('Tree');
    public $validate = array(
        'source' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Source is required'
            )
        ),
        'medium' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Medium is required'
            )
        ),
        'campaign' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Campaign is required'
            )
        )
    );

    /**
     * Get UTM data as hierarchical tree structure
     */
    public function getUtmTree($page = 1, $limit = 20) {
        $offset = ($page - 1) * $limit;
        
        // Get root sources with pagination
        $sources = $this->find('all', array(
            'conditions' => array(
                'parent_id IS NULL'
            ),
            'limit' => $limit,
            'offset' => $offset,
            'recursive' => -1
        ));
        
        // Get total count for pagination
        $total = $this->find('count', array(
            'conditions' => array(
                'parent_id IS NULL'
            ),
            'recursive' => -1
        ));
        
        $tree = array();
        
        foreach ($sources as $source) {
            $sourceData = array(
                'UtmDatum' => $source['UtmDatum'],
                'children' => $this->getChildrenRecursive($source['UtmDatum']['id'])
            );
            $tree[] = $sourceData;
        }
        
        return array(
            'tree' => $tree,
            'total' => $total,
            'page' => $page,
            'limit' => $limit
        );
    }

    /**
     * Get children recursively
     */
    private function getChildrenRecursive($parentId) {
        $children = $this->find('all', array(
            'conditions' => array(
                'parent_id' => $parentId
            ),
            'recursive' => -1
        ));
        
        $result = array();
        
        foreach ($children as $child) {
            $childData = array(
                'UtmDatum' => $child['UtmDatum'],
                'children' => $this->getChildrenRecursive($child['UtmDatum']['id'])
            );
            $result[] = $childData;
        }
        
        return $result;
    }
}
?>