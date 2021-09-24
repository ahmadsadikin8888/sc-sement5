<?php
require APPPATH . 'controllers/sistem/General_title.php';
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ebs_indihome_config {
	


   function __construct(){
	   /* title */
	    $this->general		= new General_title();
		$this->helpdesk_forcall_id	= 'ID';
		$this->helpdesk_forcall_PETUGAS	= 'PETUGAS';
		$this->helpdesk_forcall_ADDON	= 'ADDON';
		$this->helpdesk_forcall_STATUS_SC	= 'STATUS_SC';
		$this->helpdesk_forcall_NDEM	= 'NDEM';
		$this->helpdesk_forcall_COPER	= 'COPER';
		$this->helpdesk_forcall_CAGENT	= 'CAGENT';
		$this->helpdesk_forcall_KAWASAN	= 'KAWASAN';
		$this->helpdesk_forcall_WITEL	= 'WITEL';
		$this->helpdesk_forcall_C_WITEL	= 'C_WITEL';
		$this->helpdesk_forcall_C_DATEL_NEW	= 'C_DATEL_NEW';
		$this->helpdesk_forcall_STO	= 'STO';
		$this->helpdesk_forcall_CHANEL	= 'CHANEL';
		$this->helpdesk_forcall_ALPRO	= 'ALPRO';
		$this->helpdesk_forcall_TGL_VA	= 'TGL_VA';
		$this->helpdesk_forcall_umur	= 'UMUR';
		$this->helpdesk_forcall_cek	= 'CEK';
		$this->helpdesk_forcall_CGEST	= 'CGEST';
		$this->helpdesk_forcall_CSEG	= 'CSEG';
		$this->helpdesk_forcall_CCAT	= 'CCAT';
		$this->helpdesk_forcall_LINECATS_FAMILY_LNAME	= 'LINECATS_FAMILY_LNAME';
		$this->helpdesk_forcall_TEMATIK	= 'TEMATIK';
		$this->helpdesk_forcall_ITEM	= 'ITEM';
		$this->helpdesk_forcall_CPACK	= 'CPACK';
		$this->helpdesk_forcall_PSB	= 'PSB';
		$this->helpdesk_forcall_CBT	= 'CBT';
		$this->helpdesk_forcall_MIG	= 'MIG';
		$this->helpdesk_forcall_PRICE_PSB	= 'PRICE_PSB';
		$this->helpdesk_forcall_PRICE_CBT	= 'PRICE_CBT';
		$this->helpdesk_forcall_PRICE_MIG	= 'PRICE_MIG';
		$this->helpdesk_forcall_FLAG_BUNDLING	= 'FLAG_BUNDLING';
		$this->helpdesk_forcall_BUNDLING_2P3P	= 'BUNDLING_2P3P';
		$this->helpdesk_forcall_BUNDLING_STB	= 'BUNDLING_STB';
		$this->helpdesk_forcall_BUNDLING_WIFIEXT	= 'BUNDLING_WIFIEXT';
		$this->helpdesk_forcall_EXTERNAL_ORDER_ID	= 'EXTERNAL_ORDER_ID';
		$this->helpdesk_forcall_BUNDLING_INDIBOX	= 'BUNDLING_INDIBOX';
		$this->helpdesk_forcall_ND_SPEEDY	= 'ND_SPEEDY';
		$this->helpdesk_forcall_KCONTACT	= 'KCONTACT';
		$this->helpdesk_forcall_XS6	= 'XS6';
		$this->helpdesk_forcall_HASIL	= 'HASIL';
		$this->helpdesk_forcall_KETERANGAN	= 'KETERANGAN';

		
		
		
		/*field_alias_database db*/
		$this->f_id	= 'id';
		$this->f_PETUGAS	= 'PETUGAS';
		$this->f_ADDON	= 'ADDON';
		$this->f_STATUS_SC	= 'STATUS_SC';
		$this->f_NDEM	= 'NDEM';
		$this->f_COPER	= 'COPER';
		$this->f_CAGENT	= 'CAGENT';
		$this->f_KAWASAN	= 'KAWASAN';
		$this->f_WITEL	= 'WITEL';
		$this->f_C_WITEL	= 'C_WITEL';
		$this->f_C_DATEL_NEW	= 'C_DATEL_NEW';
		$this->f_STO	= 'STO';
		$this->f_CHANEL	= 'CHANEL';
		$this->f_ALPRO	= 'ALPRO';
		$this->f_TGL_VA	= 'TGL_VA';
		$this->f_umur	= 'umur';
		$this->f_cek	= 'cek';
		$this->f_CGEST	= 'CGEST';
		$this->f_CSEG	= 'CSEG';
		$this->f_CCAT	= 'CCAT';
		$this->f_LINECATS_FAMILY_LNAME	= 'LINECATS_FAMILY_LNAME';
		$this->f_TEMATIK	= 'TEMATIK';
		$this->f_ITEM	= 'ITEM';
		$this->f_CPACK	= 'CPACK';
		$this->f_PSB	= 'PSB';
		$this->f_CBT	= 'CBT';
		$this->f_MIG	= 'MIG';
		$this->f_PRICE_PSB	= 'PRICE_PSB';
		$this->f_PRICE_CBT	= 'PRICE_CBT';
		$this->f_PRICE_MIG	= 'PRICE_MIG';
		$this->f_FLAG_BUNDLING	= 'FLAG_BUNDLING';
		$this->f_BUNDLING_2P3P	= 'BUNDLING_2P3P';
		$this->f_BUNDLING_STB	= 'BUNDLING_STB';
		$this->f_BUNDLING_WIFIEXT	= 'BUNDLING_WIFIEXT';
		$this->f_EXTERNAL_ORDER_ID	= 'EXTERNAL_ORDER_ID';
		$this->f_BUNDLING_INDIBOX	= 'BUNDLING_INDIBOX';
		$this->f_ND_SPEEDY	= 'ND_SPEEDY';
		$this->f_KCONTACT	= 'KCONTACT';
		$this->f_XS6	= 'XS6';
		$this->f_HASIL	= 'HASIL';
		$this->f_KETERANGAN	= 'KETERANGAN';

		
		
		
		/* CONFIG FORM LIST */
		/* field_alias_database => $title */	
		$this->table_column =array(
			$this->f_id	=> $this->helpdesk_forcall_id,
			$this->f_PETUGAS	=> $this->helpdesk_forcall_PETUGAS,
			$this->f_ADDON	=> $this->helpdesk_forcall_ADDON,
			$this->f_STATUS_SC	=> $this->helpdesk_forcall_STATUS_SC,
			$this->f_NDEM	=> $this->helpdesk_forcall_NDEM,
			$this->f_COPER	=> $this->helpdesk_forcall_COPER,
			$this->f_CAGENT	=> $this->helpdesk_forcall_CAGENT,
			$this->f_KAWASAN	=> $this->helpdesk_forcall_KAWASAN,
			$this->f_WITEL	=> $this->helpdesk_forcall_WITEL,
			$this->f_C_WITEL	=> $this->helpdesk_forcall_C_WITEL,
			$this->f_C_DATEL_NEW	=> $this->helpdesk_forcall_C_DATEL_NEW,
			$this->f_STO	=> $this->helpdesk_forcall_STO,
			$this->f_CHANEL	=> $this->helpdesk_forcall_CHANEL,
			$this->f_ALPRO	=> $this->helpdesk_forcall_ALPRO,
			$this->f_TGL_VA	=> $this->helpdesk_forcall_TGL_VA,
			$this->f_umur	=> $this->helpdesk_forcall_umur,
			$this->f_cek	=> $this->helpdesk_forcall_cek,
			$this->f_CGEST	=> $this->helpdesk_forcall_CGEST,
			$this->f_CSEG	=> $this->helpdesk_forcall_CSEG,
			$this->f_CCAT	=> $this->helpdesk_forcall_CCAT,
			$this->f_LINECATS_FAMILY_LNAME	=> $this->helpdesk_forcall_LINECATS_FAMILY_LNAME,
			$this->f_TEMATIK	=> $this->helpdesk_forcall_TEMATIK,
			$this->f_ITEM	=> $this->helpdesk_forcall_ITEM,
			$this->f_CPACK	=> $this->helpdesk_forcall_CPACK,
			$this->f_PSB	=> $this->helpdesk_forcall_PSB,
			$this->f_CBT	=> $this->helpdesk_forcall_CBT,
			$this->f_MIG	=> $this->helpdesk_forcall_MIG,
			$this->f_PRICE_PSB	=> $this->helpdesk_forcall_PRICE_PSB,
			$this->f_PRICE_CBT	=> $this->helpdesk_forcall_PRICE_CBT,
			$this->f_PRICE_MIG	=> $this->helpdesk_forcall_PRICE_MIG,
			$this->f_FLAG_BUNDLING	=> $this->helpdesk_forcall_FLAG_BUNDLING,
			$this->f_BUNDLING_2P3P	=> $this->helpdesk_forcall_BUNDLING_2P3P,
			$this->f_BUNDLING_STB	=> $this->helpdesk_forcall_BUNDLING_STB,
			$this->f_BUNDLING_WIFIEXT	=> $this->helpdesk_forcall_BUNDLING_WIFIEXT,
			$this->f_EXTERNAL_ORDER_ID	=> $this->helpdesk_forcall_EXTERNAL_ORDER_ID,
			$this->f_BUNDLING_INDIBOX	=> $this->helpdesk_forcall_BUNDLING_INDIBOX,
			$this->f_ND_SPEEDY	=> $this->helpdesk_forcall_ND_SPEEDY,
			$this->f_KCONTACT	=> $this->helpdesk_forcall_KCONTACT,
			$this->f_XS6	=> $this->helpdesk_forcall_XS6,
			$this->f_HASIL	=> $this->helpdesk_forcall_HASIL,
			$this->f_KETERANGAN	=> $this->helpdesk_forcall_KETERANGAN,
		);

	}

};









/* END */
/* Mohon untuk tidak mengubah informasi ini : */
/* Generated by YBS CRUD Generator 2020-11-09 06:32:14 */
/* contact : YAP BRIDGING SYSTEM 		*/
/*			 bridging.system@gmail.com  */
/* 			 MAKASSAR CITY, INDONESIAN 	*/

