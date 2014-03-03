<?php

/**
 * This is the model class for table "Pensioner_Master".
 *
 * The followings are the available columns in table 'Pensioner_Master':
 * @property string $state_code
 * @property string $district_code
 * @property string $rural_urban_area
 * @property string $sub_district_municipal_area_code
 * @property string $gram_panchayat_ward_code
 * @property string $village_code
 * @property string $habitation_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $father_husband_name
 * @property string $nominee_name
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property integer $pincode
 * @property integer $beat_code
 * @property integer $bpl_year
 * @property string $bpl_location
 * @property integer $bpl_member_id
 * @property string $bpl_family_id
 * @property string $gender
 * @property integer $age
 * @property string $date_of_birth
 * @property string $category_code
 * @property integer $annual_income
 * @property string $widows
 * @property string $disability_status
 * @property string $disability_code_1
 * @property string $disability_code_2
 * @property string $disability_code_3
 * @property integer $disability_percent
 * @property string $epic_no
 * @property string $rationcard_no
 * @property string $disbursement_code
 * @property string $sanction_order_no
 * @property string $sanction_date
 * @property string $disbursement_upto
 * @property string $age_cert_issue_auth
 * @property string $age_cert_issue_date
 * @property string $inc_cert_issue_auth
 * @property string $inc_cert_issue_date
 * @property string $res_cert_issue_auth
 * @property string $res_cert_issue_date
 * @property string $dis_cert_issue_auth
 * @property string $dis_cert_issue_date
 * @property string $death_cert_issue_auth
 * @property string $death_cert_issue_date
 * @property string $account_number
 * @property string $beneficiary_number
 * @property string $sanctioning_authority
 * @property string $minority_status
 * @property string $pda_rural_urban_area
 * @property string $pda_sub_district_municipal_area_name
 * @property string $pda_gram_panchayat_ward_name
 * @property string $bank_type
 * @property string $bank_po_pda_name
 * @property string $bank_branch_name
 * @property string $Mark
 * @property integer $RBI
 * @property integer $BRCD
 * @property string $PO
 * @property string $NP
 * @property string $SubCat
 * @property string $Tehsil
 * @property string $register_no
 * @property string $Entry_Dt
 * @property string $Dead_OverAge
 * @property string $Pro_Status
 * @property string $Start_Month
 * @property double $Start_Year
 * @property double $Pension_Amt1
 * @property double $Pension_Amt2
 * @property double $Inst_1_Round
 * @property double $Inst_2_Round
 * @property string $OtherDist
 * @property string $chkno
 * @property string $chkno_Date
 */
class tempimporter3PensionerMaster extends CActiveRecord1
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PensionerMaster the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'Pensioner_Master';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pincode, beat_code, bpl_year, bpl_member_id, age, annual_income, disability_percent, RBI, BRCD', 'numerical', 'integerOnly'=>true),
			array('Start_Year, Pension_Amt1, Pension_Amt2, Inst_1_Round, Inst_2_Round', 'numerical'),
			array('state_code, district_code, sub_district_municipal_area_code, gram_panchayat_ward_code, village_code, bpl_location, category_code, disability_code_1, disability_code_2, disability_code_3, bank_type', 'length', 'max'=>40),
			array('rural_urban_area, gender, widows, disability_status, minority_status, pda_rural_urban_area, Dead_OverAge, Pro_Status, OtherDist', 'length', 'max'=>1),
			array('habitation_name, bank_po_pda_name, bank_branch_name', 'length', 'max'=>80),
			array('first_name, middle_name, last_name, father_husband_name, nominee_name, address1, address2, address3, sanction_order_no, age_cert_issue_auth, inc_cert_issue_auth, res_cert_issue_auth, dis_cert_issue_auth, death_cert_issue_auth', 'length', 'max'=>100),
			array('bpl_family_id, rationcard_no', 'length', 'max'=>12),
			array('epic_no', 'length', 'max'=>16),
			array('disbursement_code', 'length', 'max'=>3),
			array('account_number, Start_Month, chkno', 'length', 'max'=>20),
			array('beneficiary_number', 'length', 'max'=>10),
			array('sanctioning_authority', 'length', 'max'=>60),
			array('pda_sub_district_municipal_area_name, pda_gram_panchayat_ward_name, PO, NP, SubCat, Tehsil', 'length', 'max'=>50),
			array('Mark', 'length', 'max'=>255),
			array('register_no', 'length', 'max'=>25),
			array('date_of_birth, sanction_date, disbursement_upto, age_cert_issue_date, inc_cert_issue_date, res_cert_issue_date, dis_cert_issue_date, death_cert_issue_date, Entry_Dt, chkno_Date', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('state_code, district_code, rural_urban_area, sub_district_municipal_area_code, gram_panchayat_ward_code, village_code, habitation_name, first_name, middle_name, last_name, father_husband_name, nominee_name, address1, address2, address3, pincode, beat_code, bpl_year, bpl_location, bpl_member_id, bpl_family_id, gender, age, date_of_birth, category_code, annual_income, widows, disability_status, disability_code_1, disability_code_2, disability_code_3, disability_percent, epic_no, rationcard_no, disbursement_code, sanction_order_no, sanction_date, disbursement_upto, age_cert_issue_auth, age_cert_issue_date, inc_cert_issue_auth, inc_cert_issue_date, res_cert_issue_auth, res_cert_issue_date, dis_cert_issue_auth, dis_cert_issue_date, death_cert_issue_auth, death_cert_issue_date, account_number, beneficiary_number, sanctioning_authority, minority_status, pda_rural_urban_area, pda_sub_district_municipal_area_name, pda_gram_panchayat_ward_name, bank_type, bank_po_pda_name, bank_branch_name, Mark, RBI, BRCD, PO, NP, SubCat, Tehsil, register_no, Entry_Dt, Dead_OverAge, Pro_Status, Start_Month, Start_Year, Pension_Amt1, Pension_Amt2, Inst_1_Round, Inst_2_Round, OtherDist, chkno, chkno_Date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'state_code' => 'State Code',
			'district_code' => 'District Code',
			'rural_urban_area' => 'Rural Urban Area',
			'sub_district_municipal_area_code' => 'Sub District Municipal Area Code',
			'gram_panchayat_ward_code' => 'Gram Panchayat Ward Code',
			'village_code' => 'Village Code',
			'habitation_name' => 'Habitation Name',
			'first_name' => 'First Name',
			'middle_name' => 'Middle Name',
			'last_name' => 'Last Name',
			'father_husband_name' => 'Father Husband Name',
			'nominee_name' => 'Nominee Name',
			'address1' => 'Address1',
			'address2' => 'Address2',
			'address3' => 'Address3',
			'pincode' => 'Pincode',
			'beat_code' => 'Beat Code',
			'bpl_year' => 'Bpl Year',
			'bpl_location' => 'Bpl Location',
			'bpl_member_id' => 'Bpl Member',
			'bpl_family_id' => 'Bpl Family',
			'gender' => 'Gender',
			'age' => 'Age',
			'date_of_birth' => 'Date Of Birth',
			'category_code' => 'Category Code',
			'annual_income' => 'Annual Income',
			'widows' => 'Widows',
			'disability_status' => 'Disability Status',
			'disability_code_1' => 'Disability Code 1',
			'disability_code_2' => 'Disability Code 2',
			'disability_code_3' => 'Disability Code 3',
			'disability_percent' => 'Disability Percent',
			'epic_no' => 'Epic No',
			'rationcard_no' => 'Rationcard No',
			'disbursement_code' => 'Disbursement Code',
			'sanction_order_no' => 'Sanction Order No',
			'sanction_date' => 'Sanction Date',
			'disbursement_upto' => 'Disbursement Upto',
			'age_cert_issue_auth' => 'Age Cert Issue Auth',
			'age_cert_issue_date' => 'Age Cert Issue Date',
			'inc_cert_issue_auth' => 'Inc Cert Issue Auth',
			'inc_cert_issue_date' => 'Inc Cert Issue Date',
			'res_cert_issue_auth' => 'Res Cert Issue Auth',
			'res_cert_issue_date' => 'Res Cert Issue Date',
			'dis_cert_issue_auth' => 'Dis Cert Issue Auth',
			'dis_cert_issue_date' => 'Dis Cert Issue Date',
			'death_cert_issue_auth' => 'Death Cert Issue Auth',
			'death_cert_issue_date' => 'Death Cert Issue Date',
			'account_number' => 'Account Number',
			'beneficiary_number' => 'Beneficiary Number',
			'sanctioning_authority' => 'Sanctioning Authority',
			'minority_status' => 'Minority Status',
			'pda_rural_urban_area' => 'Pda Rural Urban Area',
			'pda_sub_district_municipal_area_name' => 'Pda Sub District Municipal Area Name',
			'pda_gram_panchayat_ward_name' => 'Pda Gram Panchayat Ward Name',
			'bank_type' => 'Bank Type',
			'bank_po_pda_name' => 'Bank Po Pda Name',
			'bank_branch_name' => 'Bank Branch Name',
			'Mark' => 'Mark',
			'RBI' => 'Rbi',
			'BRCD' => 'Brcd',
			'PO' => 'Po',
			'NP' => 'Np',
			'SubCat' => 'Sub Cat',
			'Tehsil' => 'Tehsil',
			'register_no' => 'Register No',
			'Entry_Dt' => 'Entry Dt',
			'Dead_OverAge' => 'Dead Over Age',
			'Pro_Status' => 'Pro Status',
			'Start_Month' => 'Start Month',
			'Start_Year' => 'Start Year',
			'Pension_Amt1' => 'Pension Amt1',
			'Pension_Amt2' => 'Pension Amt2',
			'Inst_1_Round' => 'Inst 1 Round',
			'Inst_2_Round' => 'Inst 2 Round',
			'OtherDist' => 'Other Dist',
			'chkno' => 'Chkno',
			'chkno_Date' => 'Chkno Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('state_code',$this->state_code,true);
		$criteria->compare('district_code',$this->district_code,true);
		$criteria->compare('rural_urban_area',$this->rural_urban_area,true);
		$criteria->compare('sub_district_municipal_area_code',$this->sub_district_municipal_area_code,true);
		$criteria->compare('gram_panchayat_ward_code',$this->gram_panchayat_ward_code,true);
		$criteria->compare('village_code',$this->village_code,true);
		$criteria->compare('habitation_name',$this->habitation_name,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('middle_name',$this->middle_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('father_husband_name',$this->father_husband_name,true);
		$criteria->compare('nominee_name',$this->nominee_name,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('address3',$this->address3,true);
		$criteria->compare('pincode',$this->pincode);
		$criteria->compare('beat_code',$this->beat_code);
		$criteria->compare('bpl_year',$this->bpl_year);
		$criteria->compare('bpl_location',$this->bpl_location,true);
		$criteria->compare('bpl_member_id',$this->bpl_member_id);
		$criteria->compare('bpl_family_id',$this->bpl_family_id,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('date_of_birth',$this->date_of_birth,true);
		$criteria->compare('category_code',$this->category_code,true);
		$criteria->compare('annual_income',$this->annual_income);
		$criteria->compare('widows',$this->widows,true);
		$criteria->compare('disability_status',$this->disability_status,true);
		$criteria->compare('disability_code_1',$this->disability_code_1,true);
		$criteria->compare('disability_code_2',$this->disability_code_2,true);
		$criteria->compare('disability_code_3',$this->disability_code_3,true);
		$criteria->compare('disability_percent',$this->disability_percent);
		$criteria->compare('epic_no',$this->epic_no,true);
		$criteria->compare('rationcard_no',$this->rationcard_no,true);
		$criteria->compare('disbursement_code',$this->disbursement_code,true);
		$criteria->compare('sanction_order_no',$this->sanction_order_no,true);
		$criteria->compare('sanction_date',$this->sanction_date,true);
		$criteria->compare('disbursement_upto',$this->disbursement_upto,true);
		$criteria->compare('age_cert_issue_auth',$this->age_cert_issue_auth,true);
		$criteria->compare('age_cert_issue_date',$this->age_cert_issue_date,true);
		$criteria->compare('inc_cert_issue_auth',$this->inc_cert_issue_auth,true);
		$criteria->compare('inc_cert_issue_date',$this->inc_cert_issue_date,true);
		$criteria->compare('res_cert_issue_auth',$this->res_cert_issue_auth,true);
		$criteria->compare('res_cert_issue_date',$this->res_cert_issue_date,true);
		$criteria->compare('dis_cert_issue_auth',$this->dis_cert_issue_auth,true);
		$criteria->compare('dis_cert_issue_date',$this->dis_cert_issue_date,true);
		$criteria->compare('death_cert_issue_auth',$this->death_cert_issue_auth,true);
		$criteria->compare('death_cert_issue_date',$this->death_cert_issue_date,true);
		$criteria->compare('account_number',$this->account_number,true);
		$criteria->compare('beneficiary_number',$this->beneficiary_number,true);
		$criteria->compare('sanctioning_authority',$this->sanctioning_authority,true);
		$criteria->compare('minority_status',$this->minority_status,true);
		$criteria->compare('pda_rural_urban_area',$this->pda_rural_urban_area,true);
		$criteria->compare('pda_sub_district_municipal_area_name',$this->pda_sub_district_municipal_area_name,true);
		$criteria->compare('pda_gram_panchayat_ward_name',$this->pda_gram_panchayat_ward_name,true);
		$criteria->compare('bank_type',$this->bank_type,true);
		$criteria->compare('bank_po_pda_name',$this->bank_po_pda_name,true);
		$criteria->compare('bank_branch_name',$this->bank_branch_name,true);
		$criteria->compare('Mark',$this->Mark,true);
		$criteria->compare('RBI',$this->RBI);
		$criteria->compare('BRCD',$this->BRCD);
		$criteria->compare('PO',$this->PO,true);
		$criteria->compare('NP',$this->NP,true);
		$criteria->compare('SubCat',$this->SubCat,true);
		$criteria->compare('Tehsil',$this->Tehsil,true);
		$criteria->compare('register_no',$this->register_no,true);
		$criteria->compare('Entry_Dt',$this->Entry_Dt,true);
		$criteria->compare('Dead_OverAge',$this->Dead_OverAge,true);
		$criteria->compare('Pro_Status',$this->Pro_Status,true);
		$criteria->compare('Start_Month',$this->Start_Month,true);
		$criteria->compare('Start_Year',$this->Start_Year);
		$criteria->compare('Pension_Amt1',$this->Pension_Amt1);
		$criteria->compare('Pension_Amt2',$this->Pension_Amt2);
		$criteria->compare('Inst_1_Round',$this->Inst_1_Round);
		$criteria->compare('Inst_2_Round',$this->Inst_2_Round);
		$criteria->compare('OtherDist',$this->OtherDist,true);
		$criteria->compare('chkno',$this->chkno,true);
		$criteria->compare('chkno_Date',$this->chkno_Date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}