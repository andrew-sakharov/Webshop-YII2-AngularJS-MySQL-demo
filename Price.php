<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price_list".
 *
 * @property int $id
 * @property int $users_id
 * @property int $plantations_id
 * @property int $types_id
 * @property int $sorts_id
 * @property string $create_date
 * @property string $update_date Status Change Time
 * @property string $is_deleted
 * @property int $group_id
 * @property string $nl_id
 * @property string $nl_product_id
 * @property int $minimum_length
 * @property int $quantity
 * @property string $flag
 * @property int $price_chargeamount
 * @property string $quality_group
 * @property int $packing_innerpackagequantity
 * @property string $quantity_unitcode
 * @property string $grower
 * @property string $maturity_stage
 */
class Price extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'price_list';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['users_id', 'plantations_id', 'types_id', 'sorts_id'], 'required'],
            [['users_id', 'plantations_id', 'types_id', 'sorts_id', 'group_id', 'minimum_length', 'quantity', 'price_chargeamount', 'packing_innerpackagequantity'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['is_deleted'], 'string'],
            [['nl_id', 'nl_product_id'], 'string', 'max' => 20],
            [['flag', 'quantity_unitcode'], 'string', 'max' => 3],
            [['quality_group', 'maturity_stage'], 'string', 'max' => 10],
            [['grower'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'users_id' => 'Users ID',
            'plantations_id' => 'Plantations ID',
            'types_id' => 'Types ID',
            'sorts_id' => 'Sorts ID',
            'create_date' => 'Create Date',
            'update_date' => 'Update Date',
            'is_deleted' => 'Is Deleted',
            'group_id' => 'Group ID',
            'nl_id' => 'Nl ID',
            'nl_product_id' => 'Nl Product ID',
            'minimum_length' => 'Minimum Length',
            'quantity' => 'Quantity',
            'flag' => 'Flag',
            'price_chargeamount' => 'Price Chargeamount',
            'quality_group' => 'Quality Group',
            'packing_innerpackagequantity' => 'Packing Innerpackagequantity',
            'quantity_unitcode' => 'Quantity Unitcode',
            'grower' => 'Grower',
            'maturity_stage' => 'Maturity Stage',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PriceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PriceQuery(get_called_class());
    }
    
    public function getSorts()
    {
        return $this->hasOne(Sorts::className(), ['id' => 'sorts_id']);
    }
    
    public function getTypes()
    {
        return $this->hasOne(Types::className(), ['id' => 'types_id']);
    }
    
    public function getPlantations()
    {
        return $this->hasOne(Plantations::className(), ['id' => 'plantations_id']);
    }
}
