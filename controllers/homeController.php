<?php
class homeController extends Controller {

	public function __construct() {
		parent::__construct();

		$this->user = new Users();
		if (!$this->user->checkLogin()) {
			header("Location: ".BASE_URL."login");
			exit;
		}
	}

    public function index() {
        $data = array();
        $p = new Products();

        $search = '';

        if (!empty($_GET['busca'])) {
        	$search = $_GET['busca'];	
        }

        $data['list'] = $p->getProducts($search);

        $this->loadTemplate('home', $data);
    }

    public function add() {
    	$data = array();
    	$p = new Products();

    	if (!empty($_POST['cod'])) {
    		$cod = $_POST['cod'];
    		$name = $_POST['name'];
    		$price = $_POST['price'];
    		$quantity = $_POST['quantity'];
    		$min_quantity = $_POST['min_quantity']; 

    		$p->addProduct($cod, $name, $price, $quantity, $min_quantity);

    		header("Location: ".BASE_URL);
    		exit;
    	}

    	$this->loadTemplate('add', $data);
    }

    public function editProduct() {

    }

    public function edit($id) {
    	$data = array(); 
    	$p = new Products();

    	if (!empty($_POST['cod'])) {
    		$cod = $_POST['cod'];
    		$name = $_POST['name'];
    		$price = $_POST['price'];
    		$quantity = $_POST['quantity'];
    		$min_quantity = $_POST['min_quantity']; 

    		$p->editProduct($cod, $name, $price, $quantity, $min_quantity, $id);

    		header("Location: ".BASE_URL);
    		exit;
    	}

    	$data['info'] = $p->getProduct($id);

    	$this->loadTemplate('edit', $data);
    }

}