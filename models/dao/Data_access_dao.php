<?php
 /** 汎用的なDAOクラス
 * @package    onboarding_system
 * @subpackage -
 * @category   -
 * @author     -
 * @link       -
 */
class Data_access
{
    /**
     * DSN接頭辞
     *  @var string
     */
    private $dsn_prefix;

    /**
     * ホスト名
     * @var string
     */
    private $host;

    /**
     * ポート番号
     *  @var string 
     */
    private $port;
    
    /*
     * データベース名
     *  @var string 
     */
    private $dbname;

    /**
     * ユーザー名 
     * @var string 
     */
    private $user;
    
    /**
     * パスワード
     * @var string
     */
    private $password;

    /**
     * データソース名
     * @var string
     */
    private $dsn;

    /**
     * 登録者名、更新者名
     * @var string
     */
    const PERSON = "system";
    
    /**
     * コンストラクタ
     */
    public function __construct()
    {
        // configファイルの情報を取得する
        $dsn_config = parse_ini_file("../config.ini", TRUE); 
        $this->dsn_prefix =  $dsn_config["dsn_config"]["dsn_prefix"];
        $this->host =        $dsn_config["dsn_config"]["host"];
        $this->port =        $dsn_config["dsn_config"]["port"];
        $this->dbname =      $dsn_config["dsn_config"]["dbname"];
        $this->user =        $dsn_config["dsn_config"]["user"];
        $this->password =    $dsn_config["dsn_config"]["password"];

        // 取得した情報を結合する
        $this->dsn = $this->dsn_prefix . ":host=" . $this->host .";port=" . $this->port .";dbname=" . $this->dbname;
        
    }

    /**
     * データベースと接続する
     * @return object $dbh
     */
    public function db_start()
    {
        try
        {
            $dbh = new PDO(
                    $this->dsn,
                    $this->user,
                    $this->password,
                    array(
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => FALSE
                    )
                );
        }
        catch(PDOException $e)
        {
            throw $e;
        }
        return $dbh;
    }
    /**
     * データベースと切断する
     * @param object $dbh
     */
    public function db_close($dbh)
    {
        $dbh = null;
    }
}