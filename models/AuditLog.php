<?php
/**
 * @package    yiisoft\yii2
 * @subpackage lisi4ok\yii2-auditlog
 * @author     Nikola Haralamov <lisi4ok@gmail.com>
 * @since      2.0.6
 */

namespace ozantopoglu\auditlog\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "auditlog".
 *
 * @property integer $id
 * @property string $model
 * @property integer $pk
 * @property string $action
 * @property string $old
 * @property string $new
 * @property string $at
 * @property string $by
 */
class AuditLog extends ActiveRecord
{
	public static function tableName()
	{
		return 'auditlog';
	}

	public function rules()
	{
		return [
			[['model', 'action','pk'], 'required'],
			[['old', 'new'], 'string'],
			[['at', 'by'], 'safe'],
			[['model', 'action'], 'string', 'max' => 255],
		];
	}

	public function attributeLabels()
	{
		return [
			'id' => Yii::t('app', 'ID'),
			'model' => Yii::t('app', 'Model'),
			'pk' => Yii::t('app', 'Primary Key'),
			'action' => Yii::t('app', 'Action'),
			'old' => Yii::t('app', 'Old Attributes'),
			'new' => Yii::t('app', 'New Attributes'),
			'at' => Yii::t('app', 'Changed At'),
			'by' => Yii::t('app', 'Changed By'),
		];
	}
}
