<?php
/**
 * @package    yiisoft\yii2
 * @subpackage topogluo\yii2-auditlog
 * @author     Nikola Haralamov <lisi4ok@gmail.com>
 * @author     Ozan Topoglu <ozantopoglu@yahoo.com>
 * @since      2.0.6
 */

namespace ozantopoglu\auditlog\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the search model class for table "auditlog".
 *
 */
class AuditLogSearch extends AuditLog
{
    public $author_name;

	public function rules()
	{
		return [
			[['model', 'action','pk','at', 'by','old', 'new','author_name'], 'safe'],
		];
	}

        /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = AuditLog::find()->joinWith(['author author']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>[
              'defaultOrder' => ['at'=>SORT_DESC]
            ],
           // 'pagination'=>['pageSize'=>10]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $dataProvider->sort->attributes['author_name'] = [
              'asc' => ['author.name' => SORT_ASC],
              'desc' => ['author.name' => SORT_DESC],
              'default' => SORT_ASC,
           ];

        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'pk' => $this->pk,
        ]);

        $query->andFilterWhere(['like', 'author.name', $this->author_name])
            ->andFilterWhere(['like', 'old', $this->old])
            ->andFilterWhere(['like', 'new', $this->new])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'action', $this->action]);

        return $dataProvider;
    }


}
