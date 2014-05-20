<?php

/**
 * USER
 */
class Transaction extends Base {

    public $id = "transaction_id";
    public $table = "transactions";
    public $fields = array(
        "transaction_id" => "int",
        "cart_id" => "int",
        "payment_method" => "string",
        "status" => "string",
        "address" => "string",
        "start_date" => "string",
        "end_date" => "string",
        "deleted" => "int"
    );
    public $transaction_id;
    public $cart_id;
    public $payment_method;
    public $status;
    public $address;
    public $start_date;
    public $end_date;
    public $deleted = 0;

    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_FINISHED = 'finished';
    const STATUS_ABORTED = 'aborted';

    public function __construct($obj = null) {
        parent::__construct($obj);
    }

    public function getTransactions() {
       
        $transactions = $this->get();
        foreach ($transactions as $key => $value) {
            $transactions[$key]->start_date = formatDate($transactions[$key]->start_date);
        }


        return  $transactions;
    }

    public function getTransactionById($id){

       return $this->getById($id);
    }


    /*     * **** Z POZDROWIENIAMI DLA ADAMA ***** */

    public static function finder() {
        return new self ();
    }

    public function findByCustomerID($customer_id) {
        return parent::findAll("cart_id IN (SELECT cart_id FROM carts WHERE customer_id = :customer_id)", array(":customer_id" => $customer_id));
    }

}

//class
?>