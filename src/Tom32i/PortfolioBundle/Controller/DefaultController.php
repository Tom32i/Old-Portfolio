<?php

namespace Tom32i\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
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
    			'content' => "Utiliser jQuery, c’est cool.<br/>Savoir coder en Javascript pur et orienté object : c’est autre chose.",
    			'two_lines' => false,
    		),

    		array(
    			'title' => "HTML5<br/>CSS3",
    			'color' => 'purple',
    			'content' => "Faire des coins arondis, c’est joli.<br/>S’appuyer sur les nouveaux standard du web pour servir des sites lègers, valides et responsive: c’est encore plus beau.",
    			'two_lines' => true,
    		),

    		array(
    			'title' => "...",
    			'color' => 'red',
    			'content' => "Et sinon ?<br/>Je travaille aussi avec Ruby on Rails, iOs, Flash et d’autre encore. J’expérimente sans cesse de nouveaux jouets ...",
    			'two_lines' => false,
    		),

    	);

		$projects = $em->getRepository('Tom32iPortfolioBundle:Project')->findAll();

		$methods = array(

    		array(
    			'title' => "Compter sur les autres.",
    			'content' => "La qualité d'un projet est le resultat d'une réflexion collective, d'un travail en équipe réunissant des talents divers.
                Je ne m'isole pas pour développer: je solicite au contraire beaucoup mon équipe et confronte mes idées à leur points de vue. Et ça marche!",
    		),

    		array(
    			'title' => "Chercher à comprendre.",
    			'content' => "En tant que developpeur, on peut faire mieux que simplement coder la fonctionalité demandée: 
                En connaissant le contexte et les véritables besoins des projets sur lesquels je travail, j'oriente mes client vers la solution la plus pertinante.",
			),

            array(
                'title' => "Reflechir avant d’agir.",
                'content' => "J'accorde de l'importance à la phase de conception d'un projet. 
                Mon travail de dévelopement commence toujours à l'écris, avec un crayon à papier. 
                C'est ainsi que je corrige certains problèmes avant même de les avoir codés.",
            ),

    	);

    	$tools = array( 

    		array(
    			'title' => 'Git',
                'url' => 'http://git-scm.com/',
    			'logo' => 'bundles/tom32iportfolio/images/git.svg', 
    		),

    		array(
    			'title' => 'Symfony 2', 
                'url' => 'http://symfony.com/',
    			'logo' => 'bundles/tom32iportfolio/images/symfony.svg', 
    		),

    		array(
    			'title' => 'Twitter Bootstrap', 
                'url' => 'http://twitter.github.com/bootstrap/',
    			'logo' => 'bundles/tom32iportfolio/images/bootstrap.svg', 
    		),

    		array(
    			'title' => 'Drupal',
                'url' => 'http://drupal.org/',
    			'logo' => 'bundles/tom32iportfolio/images/drupal.svg', 
    		),
    	);

        return array(
        	'languages' => $languages,
        	'projects' => $projects,
        	'methods' => $methods,
        	'tools' => $tools,
            'now' => new \DateTime(),
        );
    }
}
