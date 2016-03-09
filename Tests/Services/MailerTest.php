<?php

namespace Fgms\ShopifyBundle\Tests\Services;
use Fgms\ShopifyBundle\Services\Mailer;



class MailerTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadSystemConfig()
    {
        $mailer = new Mailer();
        $params = $mailer->get_mailerParams();
        $this->assertArrayHasKey('mailer_host',$params, 'Checking Host');
        $this->assertArrayHasKey('mailer_user',$params, 'Checking User');
        $this->assertArrayHasKey('mailer_password',$params, 'Checking Password');
    }

    public function testSendMail()
    {
        $mailer = new  Mailer();

        /*testing multipart and multi emails */
        $prop = array(	'to'=>array('shawn.turple@fifthgeardev.com'),
						'cc'=>array('shawn@turple.ca','shawn.turple@shaw.ca'),
						'bcc'=>array(),
						'from'=>'shawn.turple@fifthgeardev.com',
						'subject'=>'PHPUnit - MailerTest Multipart',
						'html'=>'<h1>Email Test</h1><p>Testing Emailer on Shopify App System -- html version</p>',
						'txt'=>"Email Test\nTesting Emailer on Shopify App System -- text version");
        $result = $mailer->sendEmail($prop);
        $this->assertArrayHasKey('status',$result , 'Mail Multipart Status');
        $this->assertGreaterThan(0,$result['status'],'Mail Multipart Result ');

        /*testing html only */
        $prop = array(	'to'=>array('shawn.turple@fifthgeardev.com'),
						'cc'=>array(),
						'bcc'=>array(),
						'from'=>'shawn.turple@fifthgeardev.com',
						'subject'=>'PHPUnit - MailerTest html only',
						'html'=>'<h1>Email Test</h1><p>Testing Emailer on Shopify App System -- html version</p>');
        $result = $mailer->sendEmail($prop);
        $this->assertArrayHasKey('status',$result , 'Mail HTML Status');
        $this->assertGreaterThan(0,$result['status'] ,'Mail HTML Result ');

        /*testing html only */
        $prop = array(	'to'=>array('shawn.turple@fifthgeardev.com'),
						'cc'=>array(),
						'bcc'=>array(),
						'from'=>'shawn.turple@fifthgeardev.com',
						'subject'=>'PHPUnit - MailerTest txt only',
						'txt'=>"Email Test\nTesting Emailer on Shopify App System -- text version");
        $result = $mailer->sendEmail($prop);
        $this->assertArrayHasKey('status',$result , 'Mail HTML Status');
        $this->assertGreaterThan(0,$result['status'],'Mail HTML Result ');



    }

}
