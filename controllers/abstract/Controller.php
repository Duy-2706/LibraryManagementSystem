<?php
include_once 'config/database.php';

class Controller {

    public function __construct() {
    
    }

    public function index() {
        $content = 'views/welcome.php';
        include('views/layouts/base.php');
    }

    public function create() {

    }

    public function edit($id) {
        
    }

    public function delete($id) {
        
    }
    public function show($id) {
        
    }
    public function detail($id) {
        
    }
    public function register() {
        
    }
    public function login() {
        
    }
    public function logout() {
        
    }
    public function store() {
        
    }
    public function register_success(){
        
    }
    public function update_status($status, $returnDate = null){
        
    }
    public function admin_dashboard(){

    }
    public function member(){
        
    }
}
?>
