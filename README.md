Yii2 Audit Log
==============
Yii2 Audit Log. This extension log all models actions -> find/insert/update/delete.
This extention is a fork from Nikola Haralamov's original extention lisi4ok/yii2-auditlog
Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist ozantopoglu/yii2-auditlog "*"
```

or add

```
"ozantopoglu/yii2-auditlog": "*"
```

to the require section of your `composer.json` file.

Go to yii app folder. and type:
```
./yii migrate --migrationPath=@vendor/ozantopoglu/yii2-auditlog/migrations
```

Usage
------------
```
<?php
namespace app\models;
use Yii;
use ozantopoglu\auditlog\behaviors\LoggableBehavior;

class MyModel extends \yii\db\ActiveRecord
{
	public function behaviors() {
		return [
			[
				'class' => LoggableBehavior::className(),
				'ignoredAttributes' => ['created_at', 'updated_at', 'created_by', 'updated_by'], // default []
				'ignorePrimaryKey' => true, // default false
				'ignorePrimaryKeyForActions' => ['insert', 'update'], //default [] Note: (if ignorePrimaryKey set to true, ignorePrimaryKeyForActions is empty will apply for all)
				'dateTimeFormat' => 'Y-m-d H:i:s', // default 'Y-m-d H:i:s'
			],
		];
	}
}
```
