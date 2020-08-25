<?php
class Gioco
	{
	private $conn;
	private $table_name = "Giochi";
	// proprietà di un Gioco
	public $Codice;
	public $Titolo;
	public $Anno;
	// costruttore
	public function __construct($db)
		{
		$this->conn = $db;
		}
	// READ Gioco
	function read()
		{
		// select all
		$query = "SELECT
                        a.Codice, a.Titolo, a.Anno
                    FROM
                   " . $this->table_name . " a ";
		$stmt = $this->conn->prepare($query);
		// execute query
		$stmt->execute();
		return $stmt;
		}
	// CREARE GIOCO
	// AGGIORNARE GIOCO
	// CANCELLARE GIOCO
	}
?>
