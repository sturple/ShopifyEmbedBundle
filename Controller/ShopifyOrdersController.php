<?php
namespace Fgms\ShopifyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Yaml\Parser;

use \Fgms\ShopifyBundle\Model\ShopifyClient;
use \Fgms\ShopifyBundle\Model\ShopifyApp;
use \Fgms\ShopifyBundle\Entity\ShopifyShopSettings;


class ShopifyOrdersController extends Controller {
    var $request = null,
		$logger = null,
		$shopify,
		$shared_secret,
		$api_key,
		$scope,
		$store_name,
		$redirect_url,
		$template_array = array();    

   
    public function indexAction(Request $request){
        $this->request = $request;   
        $name = 'shopify';
        return $this->render('FgmsShopifyBundle:Default:index.html.twig', array('name' => $name));
    }
	
	public function emailCsvAction(){
		$this-> get_app_settings() ;
		$response = new StreamedResponse();
		
		

		$response->setCallback(function(){
			/*
			while( $row = $results->fetch() )
			{
				fputcsv(
					$handle, // The file pointer
					array($row['name'], $row['surname'], $row['age'], $row['sex']), // The fields
					';' // The delimiter
				 );
			}
			*/
			$handle = fopen('php://output', 'w+');
			fputcsv($handle, array('Email', 'Last Name','First Name', 'Date','Total Spent'),',');
			
			$orderCount = intval($this->shopify->call('GET','/admin/orders/count.json'));
			$this->logger->notice('Order Count ' . print_R($orderCount,true));
			$limitCounts = 0;
			$orders = array();
			// we need to find out total order count and then we need to go fetch all orders
			while ( $orderCount > $limitCounts ){
				$limitCounts += 250;
				$orders = array_merge($orders,$this->shopify->call('GET','/admin/orders.json?fields=created_at,customer,browser_ip', array('status'=>'any','limit'=>250, 'page' =>($limitCounts/250))));
			
			}
			
			$totalCount = 0;
			$emailCount = 0;
			foreach ($orders as $item){
				//$this->logger->notice('ORDERS '.print_R($item,true));
				++$totalCount;
				if (isset($item['customer'])){
					if (strlen($item['customer']['email']) > 2){
						++$emailCount;
						fputcsv($handle, array($item['customer']['email'], $item['customer']['last_name'],$item['customer']['first_name'],$item['created_at'] ,$item['customer']['total_spent']),',');
					}
					
				}
				
			}
			$this->logger->notice("^^^^^^^^^^ Counts ORDER: ({$orderCount})   Total: ({$totalCount}) Email Count: ({$emailCount})");
			
		});

		//$this->logger->notice('ORDERS '.print_R($orders,true));
		$response->setStatusCode(200);
		$response->headers->set('Content-Type', 'text/csv; charset=utf-8');
		$response->headers->set('Content-Disposition','attachment; filename="export.csv"');
 
    return $response;		
	}
    
  
   

    private function get_app_settings() {
		$settings = ShopifyClient::GET_SETTINGS($this);
		$this->shopify = $settings['shopify'];
		$this->logger = $settings['logger'];
		$this->store_name = $settings['shop'];
		$this->template_array= array('title'=>'','output'=>'', 'products'=>array(),'shop_name'=>$settings['shop'], 'app_api'=>$settings['api_key']);	

    }
    
  
    
 
}




