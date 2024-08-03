<?php
namespace App\Providers\MMSHightech;
use App\Providers\Response\Response;
use App\Providers\Constants\StatusConstants;
class MMSHightech{
    public $connection;
    protected $ENCRYPTION_KEY;
    protected $ENCRYPTION_ALGORITHM;
    public function __construct(string $notConnected=StatusConstants::CONNECTION_STATUS_NOT_CONNECTED)
    {
        $this->dbConn();
        $this->ENCRYPTION_KEY = 'nldfg8738wfauij&^9HBH(*009*&78^7JHGJHXKJkljsnchgc-sdchug76654(*98hiwsdwqiVBORw0KGgoAAAANSUhEUgAAB4AAAAOcCAYAAACv+aw1AAAAAXNSR0IArs4c6QAAr45dkjAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAP+lSURBVHhe7N0LQBTl/j/+Nwq4CCZoxqqpoJZiFy5l233CtpR8Popular&^#)(NH(U*#(*#@H#&*Y@OIJ*()#NHG*U&DAIIGHIASDDyesfrserofjifIHUIIHuygs4iuof349now.InformasettlemenresidentMdantsaat infestation2021slKg9bg75cn/w8dfTv+uWr7OssCnM86jzGX/095ENjaN7AjFxMArn6tRIIMFmVnZ2sBo+7du8PT05PBX6JWRl67236z8tqV17C8luU1La9tIiIiIiIiIiIiIqKLYdvss6z5y+BvDUS6yPSR6STTS6abTLwq/GwAAw1UjW/dsfkspodfsdpfha348975034tjndfs980gu5mgnO3SpYtW85eIWj95Lrtert5ctrWl7bRERER43ERERERE; Imbongi yomthonyama yenze umbongo ojolisweZsm5emE1Un9dzGtTtpdT5dfsdnbjkeiuaej1c/SU5lmF7Fj+fOnbXrmYiIiIiIiIiIiIjoYRET1JYOX1tq/aw+s1Zp9ZvC3FiJ9ZDrJ9JLpJtOvMYLADABTtWR/v9Zmn4mo7ZDXtLy25TVORERERERERERERFRfshZr7KEvkedyln3+Okmmk0wvmW4sday/RoDA8BULRkcYvCXqG2S1zYDwEREREREREvdvvre2RERERUX9berfdfv';
        $this->ENCRYPTION_ALGORITHM = 'AES-256-CBC';
    }

    public function dbConn()
    {
        $user = 'root';//'u405316555_netchatsa';
        $pass = '';//'netchatsa';
        $dbnam = 'netchatsa';//'u405316555_netchatsa';
        $this->connection = mysqli_connect('localhost', $user, $pass, $dbnam) or die("Connection was not established!!");
        // Disable auto-commit
        mysqli_autocommit($this->connection, true);
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
    public function EncryptThis($ClearTextData) {
        $EncryptionKey = base64_decode($this->ENCRYPTION_KEY);
        $InitializationVector  = openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->ENCRYPTION_ALGORITHM));
        $EncryptedText = openssl_encrypt($ClearTextData, $this->ENCRYPTION_ALGORITHM, $EncryptionKey, 0, $InitializationVector);
        return base64_encode($EncryptedText . '::' . $InitializationVector);
    }
    public function DecryptThis($CipherData) {
        $EncryptionKey = base64_decode($this->ENCRYPTION_KEY);
        list($Encrypted_Data, $InitializationVector ) = array_pad(explode('::', base64_decode($CipherData), 2), 2, null);
        return openssl_decrypt($Encrypted_Data, $this->ENCRYPTION_ALGORITHM, $EncryptionKey, 0, $InitializationVector);
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