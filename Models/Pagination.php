<?php
/**
 * Created by PhpStorm.
 * User: oem
 * Date: 09/03/2018
 * Time: 16:43
 */
require_once ('Models/Database.php');
require_once ('Models/CarsData.php');

class Pagination
{
    protected $_dbHandle, $dbInstance;
    private $limit; // records to show per page
    private $page; // current page
    private $total;
    private $rowStart;

    public function __construct()
    {
        $this->dbInstance = Database::getInstance();
        $this->_dbHandle = $this->dbInstance->getdbConnection();
    }

    /**
     * @param $limit
     * @param $page
     * @return array
     *
     */
    public function getItems($limit, $page) {

        $this->limit = $limit;
        $this->page = $page;

        $this->rowStart = (($this->page - 1) * $this->limit);
        $sqlQuery = "SELECT * FROM cars_items LIMIT $this->rowStart, $this->limit ";
        $statement = $this->_dbHandle->prepare($sqlQuery);
        $statement->execute();

        $data = [];


        while ($row = $statement->fetch()) {
            $data[] = new CarsData($row);
        }
        $this->total = count($data);
        return $data;

    }


    public function links($links, $listClass, $total) {
        $this->total = $total;
        //last page number
        $last = ceil($this->total / $this->limit);
        //first link number
        $start = (($this->page - $links) > 0 ) ? $this->page - $links : 1;
        //last link number
        $end = (($this->page + $links) < $last) ? $this->page + $links : $last;


        $html = '<ul class="pagination" class="' . $listClass . '">';
        $class = ( $this->page == 1 ) ? "disabled" : ""; //disable previous page link <<<

        //create the links and pass limit and page as $_GET parameters

        //$this->_page - 1 = previous page (<<< link )
        $previousPage = ( $this->page == 1 ) ?
            '<li class="page-item" class="' . $class . '"><a class="page-link" href="">&laquo;</a></li>' : //remove link from previous button
            '<li class="page-item" class="' . $class . '"><a class="page-link" href="?limit=' . $this->limit . '&page=' . ( $this->page - 1 ) . '">&laquo;</a></li>';

        $html .= $previousPage;

        if ( $start > 1 ) { //print ... before (previous <<< link)
            $html .= '<li class="page-item"><a class="page-link" href="?limit=' . $this->limit . '&page=1">1</a></li>'; //print first page link
            $html .= '<li class="page-item" class="disabled"><span>...</span></li>'; //print 3 dots if not on first page
        }

        //print all the numbered page links
        for ( $i = $start ; $i <= $end; $i++ ) {
            $class = ( $this->page == $i ) ? "active" : ""; //highlight current page
            $html .= '<li  class="page-item" class="' . $class . '"><a class="page-link" href="?limit=' . $this->limit . '&page=' . $i . '"><span>' . $i . '</span></a></li>';
        }

        if ( $end < $last ) { //print ... before next page (>>> link)
            $html .= '<li class="page-item" class="disabled"><span>...</span></li>'; //print 3 dots if not on last page
            $html .= '<li class="page-item"><a class="page-link" href="?limit=' . $this->limit . '&page=' . $last . '">' . $last . '</a></li>'; //print last page link
        }

        $class = ( $this->page == $last ) ? "disabled" : ""; //disable (>>> next page link)

        //$this->_page + 1 = next page (>>> link)
        $next_page = ( $this->page == $last) ?
            '<li class="page-item" class="' . $class . '"><a class="page-link" href="">&raquo;</a></li>' : //remove link from next button
            '<li class="page-item" class="' . $class . '"><a class="page-link" href="?limit=' . $this->limit . '&page=' . ( $this->page + 1 ) . '">&raquo;</a></li>';

        $html .= $next_page;
        $html .= '</ul>';

        return $html;


    }





}

