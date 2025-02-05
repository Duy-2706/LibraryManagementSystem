<?php
include_once 'Model.php';
class Fine extends Model
{
    protected $table_name = 'fine';

    public $fine_id;
    public $loan_id;
    public $user_id;
    public $returned_to;
    public $issued_date;
    public $due_date;
    public $returned_date;
    public $status;
    public $notes;
    public $created_at;
    public $updated_at;

    public function __construct(){
        parent::__construct();
    }

    public function create()
    {
        return parent::create();
    }

    public function read() {
        $sql = "SELECT f.fine_id,
        l.loan_id,
        u.username AS user_name,
        r.username AS returned_to,
        f.issued_date,
        f.due_date,
        f.returned_date,
        f.status,
        f.notes
        FROM fine f
        LEFT JOIN user u ON f.user_id = u.user_id
        LEFT JOIN user r ON f.returned_to = r.user_id
        LEFT JOIN loan l ON f.loan_id = l.loan_id";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function readById($id) {
        $query = "SELECT f.fine_id,
        l.loan_id,
        u.username AS user_name,
        r.username AS returned_to,
        f.issued_date,
        f.due_date,
        f.returned_date,
        f.status,
        f.notes FROM fine f
        LEFT JOIN user u ON f.user_id = u.user_id
        LEFT JOIN user r ON f.returned_to = r.user_id
        LEFT JOIN loan l ON f.loan_id = l.loan_id
        WHERE fine_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id)
    {
        return parent::update($id);
    }

    public function delete($id)
    {
        return parent::delete($id);
    }

    public function getLoaned(){
        $sql = "SELECT u.username, l.loan_id
        FROM loan l
        JOIN user u ON l.issued_by = u.user_id
        WHERE l.status = 'overdue'
        AND NOT EXISTS (
            SELECT 1
            FROM fine f
            WHERE f.loan_id = l.loan_id
        );";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}