<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class SupplierMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {

        //建表.
        $sql  = "CREATE TABLE `supplier` (
              `id` int unsigned NOT NULL AUTO_INCREMENT,
              `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '',
              `code` char(3) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL,
              `t_status` enum('ok','hold') CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT 'ok',
              PRIMARY KEY (`id`),
              UNIQUE KEY `uk_code` (`code`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

        $this->execute($sql);



        //写入mock 数据
        $data = [];
        $str  = "abcdefghijklmnopqrstuvwxyz0123456789";

        for ($i = 0; $i < strlen($str); $i++) {
            for ($j = 0; $j < strlen($str); $j++) {
                for ($k = 0; $k < strlen($str); $k++) {
                    $code =  substr($str, $i, 1) . substr($str, $j, 1) . substr($str, $k, 1);

                    $item   = [
                        "name"     => "text" . $i . $j . $k ,
                        "code"     => $code,
                        "t_status" => mt_rand(1, 1000) % 2 == 0 ? "ok" : "hold"
                    ];
                    $data[] = $item;
                }
            }
        }

        $chunks = array_chunk($data, 1000);

        $table = $this->table('supplier');

        foreach ($chunks as $item) {
            $table->insert($item)->saveData();
        }
    }

}
