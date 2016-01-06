<?php
namespace Fgms\ShopifyBundle\Model;

define('ALLOWED_TAGS','<span><p><div><em><i><b><h1><h2><h3><h4><table><th><td><tr><thead><tbody>');
class ShopifyApp
{
	var $shopify = null,
		$request=null,
		$logger = null,
		$published_theme_id = false;	 
		 
		  
	function __construct($shopfiy, $request ,$logger) {	
		$this->shopify = $shopfiy;
		$this->request = $request;
		$this->logger = $logger;
		//$this->get_shop();
	}
	
	/****** GET SHOP ***********/
	private function get_shop() {			
		$output =  $this->shopify->call('GET','/admin/shop.json');
		$this->logger->notice('ShopifyApp::get_shop() ' .print_R($output,true));
		return $output;
		
	}
	
	/******* REQUEST DECISION *********/
	public function get_request(){
		$type = $this->request->query->get('type','');
		
		$this->logger->notice('ShopifyApp:get_request() Type: '. $type);
		return 'ShopifyApp:get_requests' .$type; ;
		$chunk = $this->modx->getOption('chunk',$this->options,false);
		
		$chunk_wrapper = $this->modx->getOption('chunk_wrapper',$this->options,false);
		if ($type == 'product-meta-data'){
			$this -> modx ->log(modX::LOG_LEVEL_DEBUG,'Product data for '. $id);			
			$chunk_meta = $this->modx->getOption('chunk_meta',$this->options,false);
			$product_data_array = $this->get_product_data($this->cdata['id']);
			$product_metadata_array = $this->get_product_meta_data($this->cdata['id']);			
			// getting information for meta data
			if ($chunk_meta !== false){
				foreach ($product_metadata_array as $meta_single){
					$meta .= $this->modx->getChunk($chunk_meta,$meta_single);
				}
				$meta .= $this->modx->getChunk($chunk_meta, array('owner_id'=>$this->cdata['id'],																  
										 						  'key'=>'',
																  'namespace'=>'FGMSTabs',
																  'value'=>''
																  ));
				
			}
			else {
				$meta = print_r($product_metadata_array,true);
			}			
			//if (strlen($meta) < 5) { $meta = print_r($product_metadata_array,true);}

			//getting information for product
			if ($chunk !== false){
				$product = $this->modx->getChunk($chunk,array_merge($product_data_array,array('metadata'=>$meta),$this->cdata));
			}
			else {
				$product = print_r($product_data_array,true);
			}			
			if (strlen($product) < 5) { $product = print_r($product_data_array,true);}

			
			$output = $product ;
			
			
		
		}
		else if ($type == 'product-meta-data-update'){
			$output = $this->post_product_meta_data($this->cdata);			
			$output = json_encode($output);
			
		}
		/********* THIS IS THE MAIN ONE FOR PRODUCT EXTRAS **************/
		else if ($type == 'product-extra'){
			$this -> modx ->log(1,'Product Extra data  for ************** '. $id);
			/***** get product general info ************/
			$product_data_array = $this->get_product_data($this->cdata['id']);
			$product_metadata_array = $this->get_product_meta_data($this->cdata['id']);
			$this -> modx ->log(1,print_r($product_metadata_array,true));
			/***** META DATA OPTIONS *****/
			$chunk_meta = $this->modx->getOption('chunk_meta',$this->options,false);
			$chunk_tab = $this->modx->getOption('chunk_tab',$this->options,false);
			$chunk_option = $this->modx->getOption('chunk_option',$this->options,false);
			$chunk_header = $this->modx->getOption('chunk_header',$this->options,false);
			
			$meta = '';	$option = ''; $header ='' ; $other = ''; $tab='';
			$header_array= array('owner_id'=>$this->cdata['id'],'namespace'=>'FGMSHeader');

			foreach ($product_metadata_array as $meta_single){
				//origional
				if ($meta_single['namespace'] == 'FGMS') {
					$meta .= $this->modx->getChunk($chunk_meta,$meta_single);
				}
				else if ($meta_single['namespace'] == 'FGMSTabs'){
					$tab .= $this->modx->getChunk($chunk_tab,$meta_single);
				}
				else if ($meta_single['namespace'] == 'FGMSOption'){
					$option .= $this->modx->getChunk($chunk_option,$meta_single);
				}
				else if ($meta_single['namespace'] == 'FGMSHeader'){
					$header_array[$meta_single['key']] = $meta_single['value'];
					$header_array[$meta_single['key'].'ID'] = $meta_single['id'];
					
				}
				else {
					$other .= '<div class="metadata-notdefined">' .print_r($meta_single,true).'</div>';
				}
			}

			//adding new entries if required
			$meta .= $this->modx->getChunk($chunk_meta, array('owner_id'=>$this->cdata['id'],																  
												  'key'=>'',
												  'namespace'=>'FGMS',
												  'value'=>''
												  ));
			$tab .= $this->modx->getChunk($chunk_tab, array('owner_id'=>$this->cdata['id'],																  
												  'key'=>'',
												  'namespace'=>'FGMSTabs',
												  'value'=>''
												  ));			

			$option .= $this->modx->getChunk($chunk_option, array('owner_id'=>$this->cdata['id'],																  
															  'key'=>'',
															  'namespace'=>'FGMSOption',
															  'value'=>''
															  ));					
			//header_array becomes a flatten version of meta tags
			
			$header = $this->modx->getChunk($chunk_header,$header_array);
			$heeader .= print_r($header_array,true);
			//getting information for product
			if ($chunk !== false){
				$product = $this->modx->getChunk($chunk,array_merge($product_data_array,array('metadata'=>$meta, 'option'=>$option,'header'=>$header,'tab'=>$tab,'other'=>$other),$this->cdata));
			}
			else {	$product = print_r($product_data_array,true);	}			
			if (strlen($product) < 5) { $product = print_r($product_data_array,true);}			
			$output = $product ;			
		}
		else if ($type == 'product-options') {
			$this -> modx ->log(modX::LOG_LEVEL_DEBUG,'Product data for '. $id);			
			$chunk_option = $this->modx->getOption('chunk_option',$this->options,false);
			$product_data_array = $this->get_product_data($this->cdata['id']);
			$product_option_array = $this->get_product_meta_data($this->cdata['id']);			
			// getting information for meta data
			if ($chunk_option !== false){
				foreach ($product_option_array as $meta_single){
					
					$option .= $this->modx->getChunk($chunk_option,$meta_single);
				}
				$option .= $this->modx->getChunk($chunk_option, array('owner_id'=>$this->cdata['id'],																  
										 						  'key'=>'',
																  'namespace'=>'FGMSOption',
																  'value'=>''
																  ));
				
			}
			else {
				$option = print_r($product_option_array,true);
			}			
			//if (strlen($meta) < 5) { $meta = print_r($product_metadata_array,true);}

			//getting information for product
			if ($chunk !== false){
				$product = $this->modx->getChunk($chunk,array_merge($product_data_array,array('option'=>$option.' '),$this->cdata));
			}
			else {
				$product = print_r($product_data_array,true);
			}			
			if (strlen($product) < 5) { $product = print_r($product_data_array,true);}

			
			$output = $product ;
		}
		else {
			if ($this->cdata['path_prefix'] == '/community/pages'){
				$this->modx->log(3,'Process proxy  '.print_r($this->cdata,true));
				$output = $this->process_proxy();
			}
			else {
				$this->modx->log(3,'No Request Made, but authorized');
				// need to figure a way that this only loads for index page otherwise this is the default load, maybe a parm needs to be on the index button
				if ( true ) {
					// this means that is the home page of the app so load table with all the products
					$products_data_array = $this->get_products();
					if ($chunk !== false){
						$p = '';
						foreach ($products_data_array  as $product){
							$product = array_merge($product,array('shop'=>$_SESSION['store_name']),$this->cdata);
							$p .= $this->modx->getChunk($chunk,$product);
						}
						if ($chunk_wrapper !== false){
							$output =  $this->modx->getChunk($chunk_wrapper,array('rows'=>$p));
						} else { $output = $p;	}
						
						
					}
					else {	$output = print_r($products_data_array,true);	}			
					if (strlen($output) < 5) { $output = print_r($products_data_array,true);}							
				}
		

				   
			}				
		}
	
	return $output;	
	}	
	
	
}

