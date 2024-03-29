<?php

namespace Tom32i\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

    	$languages = array(

    		array(
    			'title' => "PHP",
    			'color' => 'blueDark',
    			'content' => "Produire du code PHP, c’est bien.<br/>Développer en PHP Orienté Objet et structurer son code en MVC :  c’est beaucoup mieux.",
    			'two_lines' => false,
    		),

    		array(
    			'title' => "JS",
    			'color' => 'greenDark',
    			'content' => "Utiliser jQuery, c’est cool.<br/>Savoir coder en Javascript pur et utiliser les prototypes objet : c’est autre chose.",
    			'two_lines' => false,
    		),

    		array(
    			'title' => "HTML5<br/>CSS3",
    			'color' => 'purple',
    			'content' => "Faire des coins arrondis, c’est joli.<br/>S’appuyer sur les nouveaux standards du web pour servir des sites légers, valides et responsives : c’est encore plus beau.",
    			'two_lines' => true,
    		),

    		array(
    			'title' => "...",
    			'color' => 'red',
    			'content' => "Et sinon ?<br/>Je travaille aussi avec les Websockets, NodeJs, Redis, les Canvas, Ruby on Rails, Facebook API, Drupal et d’autres encore. J’expérimente sans cesse de nouveaux jouets ...",
    			'two_lines' => false,
    		),

    	);

		$projects = $em->getRepository('Tom32iPortfolioBundle:Project')->findAllOrdered();

		$methods = array(

    		array(
    			'title' => "Compter sur les autres.",
    			'content' => "La qualité d'un projet est le résultat d'une réflexion collective, d'un travail en équipe réunissant des talents divers.
                Je ne m'isole pas pour développer : je sollicite au contraire beaucoup mon équipe et confronte mes idées à leurs points de vue. Et ça marche !",
    		),

    		array(
    			'title' => "Chercher à comprendre.",
    			'content' => "En tant que développeur, on peut faire mieux que simplement coder la fonctionnalité demandée : 
                En connaissant le contexte et les véritables besoins des projets sur lesquels je travaille, j'oriente mes clients vers la solution la plus pertinente.",
			),

            array(
                'title' => "Réfléchir avant d’agir.",
                'content' => "J'accorde de l'importance à la phase de conception d'un projet. 
                Mon travail de développement commence toujours à l'écrit, avec un crayon à papier. 
                C'est ainsi que je corrige certains problèmes avant même de les avoir codés.",
            ),

    	);

    	$tools = array( 

            array(
                'title' => 'Symfony 2', 
                'url' => 'http://symfony.com',
                'logo' => 'bundles/tom32iportfolio/images/symfony.svg', 
            ),

    		array(
    			'title' => 'Git',
                'url' => 'http://git-scm.com',
    			'logo' => 'bundles/tom32iportfolio/images/git.svg', 
    		),

    		array(
    			'title' => 'Behat', 
                'url' => 'http://behat.org/',
    			'logo' => 'bundles/tom32iportfolio/images/behat.svg', 
    		),

            array(
                'title' => 'HTML5', 
                'url' => 'http://www.w3.org/TR/html5',
                'logo' => 'bundles/tom32iportfolio/images/html5.svg', 
            ),

            array(
                'title' => 'Node.js', 
                'url' => 'http://nodejs.org/',
                'logo' => 'bundles/tom32iportfolio/images/nodejs.svg', 
            ),

            array(
                'title' => 'Twitter Bootstrap', 
                'url' => 'http://twitter.github.io/bootstrap',
                'logo' => 'bundles/tom32iportfolio/images/bootstrap.svg', 
            ),

    		/*array(
    			'title' => 'Drupal',
                'url' => 'http://drupal.org/',
    			'logo' => 'bundles/tom32iportfolio/images/drupal.svg', 
    		),*/
    	);

        return array(
        	'languages' => $languages,
        	'projects' => $projects,
        	'methods' => $methods,
        	'tools' => $tools,
            'now' => new \DateTime(),
        );
    }

    /**
     * @Route("/cv", name="cv")
     * @Template()
     */
    public function cvAction()
    {
        $file = $_SERVER['DOCUMENT_ROOT'] . '/uploads/Thomas_Jarrand_CV_2013.pdf';

        /*$response = new Response(readfile($file), 200);

        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment; filename=' . basename($file));
        $response->headers->set('Content-Length', filesize($file));

        return $response;*/

        if (file_exists($file)) 
        {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
    }
}
