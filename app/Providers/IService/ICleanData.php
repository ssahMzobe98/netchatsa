<?php
namespace App\Providers\IService;
interface ICleanData{
	public function cleanData(string $mess);
    public function OMO(string $string);
    public function cleanAll(array $data =[]);
    public function lockPassWord(string $pass);
    public function verifyClientMenuStore(array $cleanData=[]);
    public function ibhubesiLesilisa($pwd);
    public function shayIqanda($iqanda,$arr);
    public function hash1($inamba);
    public function position($pos);
    public function wamaHalahle($pwd);
}
?>