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

		$projects = array(

    		array(
    			'title' => "UNISON SAFETY",
    			'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tortor arcu, dictum et adipiscing ac, lacinia et libero. Sed interdum quam non mauris tempor sit amet scelerisque erat tincidunt.",
    			'picture' => "",
			),

    		array(
    			'title' => "INHOUSE RESOURCES",
    			'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tortor arcu, dictum et adipiscing ac, lacinia et libero. Sed interdum quam non mauris tempor sit amet scelerisque erat tincidunt.",
    			'picture' => "",
			),

    		array(
    			'title' => "ARCCON",
    			'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tortor arcu, dictum et adipiscing ac, lacinia et libero. Sed interdum quam non mauris tempor sit amet scelerisque erat tincidunt.",
    			'picture' => "",
			),

    	);

		$methods = array(

    		array(
    			'title' => "Reflechir avant d’agir.",
    			'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tortor arcu, dictum et adipiscing ac, lacinia et libero. Sed interdum quam non mauris tempor sit amet scelerisque erat tincidunt.",
    		),

    		array(
    			'title' => "Compter sur les autres.",
    			'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tortor arcu, dictum et adipiscing ac, lacinia et libero. Sed interdum quam non mauris tempor sit amet scelerisque erat tincidunt.",
    		),

    		array(
    			'title' => "Chercher à comprendre.",
    			'content' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum tortor arcu, dictum et adipiscing ac, lacinia et libero. Sed interdum quam non mauris tempor sit amet scelerisque erat tincidunt.",
			),

    	);

    	$tools = array( 

    		array(
    			'title' => 'Git', 
    			'logo' => 'bundles/tom32iportfolio/images/git.svg', 
    		),

    		array(
    			'title' => 'Symfony 2', 
    			'logo' => 'bundles/tom32iportfolio/images/symfony.svg', 
    		),

    		array(
    			'title' => 'Twitter Bootstrap', 
    			'logo' => 'bundles/tom32iportfolio/images/bootstrap.svg', 
    		),

    		array(
    			'title' => 'Drupal 7',
    			'logo' => 'bundles/tom32iportfolio/images/drupal.svg', 
    		),
    	);

        return array(
        	'languages' => $languages,
        	'projects' => $projects,
        	'methods' => $methods,
        	'tools' => $tools,
        );
    }
}
