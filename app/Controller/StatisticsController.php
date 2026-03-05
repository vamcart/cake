<?php
class StatisticsController extends AppController {
    public $uses = array('UtmDatum');
    public $paginate = array(
        'limit' => 20
    );

    /**
     * Display UTM data as hierarchical tree
     */
    public function utm_list() {
        $page = isset($this->request->query['page']) ? (int)$this->request->query['page'] : 1;
        
        $utmData = $this->UtmDatum->getUtmTree($page, 20);
        
        $this->set('tree', $utmData['tree']);
        $this->set('total', $utmData['total']);
        $this->set('page', $page);
        $this->set('limit', 20);
        $this->set('totalPages', ceil($utmData['total'] / 20));
    }
}
?>