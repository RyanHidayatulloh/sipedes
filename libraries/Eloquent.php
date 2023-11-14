<?php

namespace app\libraries;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;
use yii\base\BootstrapInterface;
use yii\base\Component;

class Eloquent extends Component implements BootstrapInterface
{
    /**
     * @var string
     */
    public $driver;

    /**
     * @var string
     */
    public $host;

    /**
     * @var string
     */
    public $database;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var string
     */
    public $charset;

    /**
     * @var string
     */
    public $collation;

    /**
     * @var string
     */
    public $prefix;

    /**
     * @var Manager
     */
    private $capsule;

    /**
     * {@inheritdoc}
     */
    public function bootstrap($app)
    {
        $this->capsule = new Manager();
        $this->capsule->addConnection([
            'driver' => $this->driver,
            'host' => $this->host,
            'database' => $this->database,
            'username' => $this->username,
            'password' => $this->password,
            'charset' => $this->charset,
            'collation' => $this->collation,
            'prefix' => $this->prefix,
        ]);

        $this->capsule->setEventDispatcher(new Dispatcher(new Container()));

        $this->capsule->setAsGlobal();

        $this->capsule->bootEloquent();

        $app->set('db', $this->capsule);
    }
}