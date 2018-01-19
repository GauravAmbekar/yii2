<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "departments".
 *
 * @property integer $department_id
 * @property string $department_name
 * @property string $department_created_date
 * @property string $department_status
 * @property integer $branches_branch_id
 * @property integer $companies_company_id
 *
 * @property Branches $branchesBranch
 * @property Companies $companiesCompany
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'departments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department_name', 'department_created_date', 'department_status', 'branches_branch_id', 'companies_company_id'], 'required'],
            [['department_created_date'], 'safe'],
            [['department_status'], 'string'],
            [['branches_branch_id', 'companies_company_id'], 'integer'],
            [['department_name'], 'string', 'max' => 100],
            [['branches_branch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Branches::className(), 'targetAttribute' => ['branches_branch_id' => 'branch_id']],
            [['companies_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['companies_company_id' => 'company_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'department_id' => 'Department ID',
            'department_name' => 'Department Name',
            'department_created_date' => 'Department Created Date',
            'department_status' => 'Department Status',
//            'branches_branch_id' => 'Branches Branch ID',
            'branches_branch_id' => 'Branch Name',
            
//            'companies_company_id' => 'Companies Company ID',
            'companies_company_id' => 'Company Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranchesBranch()
    {
        return $this->hasOne(Branches::className(), ['branch_id' => 'branches_branch_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompaniesCompany()
    {
        return $this->hasOne(Companies::className(), ['company_id' => 'companies_company_id']);
    }
}
