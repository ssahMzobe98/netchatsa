<?php
namespace App\Providers\MMSHightech;
use App\Poviders\Response\Response;
use App\Providers\Constants\StatusConstants;
class MMSHightech{
    public $connection;

    public function __construct(string $notConnected=StatusConstants::CONNECTION_STATUS_NOT_CONNECTED)
    {
        $this->dbConn();
    }

    public function dbConn()
    {
        $user = 'root';
        $pass = '';
        $dbnam = 'netchatsa';
        $this->connection = mysqli_connect('localhost', $user, $pass, $dbnam) or die("Connection was not established!!");
        // Disable auto-commit
        mysqli_autocommit($this->connection, false);
    }

    public function getAllDataSafely($query, $paramType = "", $paramArray = []): array
    {
        $stmt = $this->connection->prepare($query);

        if (!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        $resultset = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                array_push($resultset, $row);
            }
        }
        return $resultset;
    }

    public function postDataSafely($query, $paramType, $paramArray): Response
    {
        $response = new Response();
        $stmt = $this->connection->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);
        $stmt->execute();
        $response->failureSetter()->messagerSetter("Failed to process due to : " . $stmt->error)->messagerArraySetter(['error' => $stmt->error, 'Error_list' => $stmt->error_list]);
        if ($stmt->errno == 0) {
            $response->successSetter()->messagerSetter($stmt->insert_id)->setObjectReturn();
        }
        return $response;
    }

    public function execute($query, $paramType = "", $paramArray = array())
    {
        $stmt = $this->connection->prepare($query);

        if (!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType = "", $paramArray = array());
        }
        $stmt->execute();
    }

    public function bindQueryParams($stmt, $paramType, $paramArray = array())
    {
        $paramValueReference[] = &$paramType;
        for ($i = 0; $i < count($paramArray); $i++) {
            $paramValueReference[] = &$paramArray[$i];
        }
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $paramValueReference);
    }

    public function numRows($query, $paramType = "", $paramArray = array()): int
    {
        $stmt = $this->connection->prepare($query);

        if (!empty($paramType) && !empty($paramArray)) {
            $this->bindQueryParams($stmt, $paramType, $paramArray);
        }

        $stmt->execute();
        $stmt->store_result();
        $recordCount = $stmt->num_rows;
        return $recordCount;
    }

    public function commit()
    {
        mysqli_commit($this->connection);
    }

    public function rollback()
    {
        mysqli_rollback($this->connection);
    }

    public function DBClose()
    {
        mysqli_close($this->connection);
    }
}
?>