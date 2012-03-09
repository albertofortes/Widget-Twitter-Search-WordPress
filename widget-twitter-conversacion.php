<?php

/*
Plugin Name: Twitter widget conversaci&oacute;n
Plugin URI: http://twitter.com/about/resources/widgets/widget_search
Description: El widget de twitter modelo Búsqueda hecho widget de Worpdress - albertofortes.com
Author: Alberto Fortes
Version: 1
Author URI: http://www.albertofortes.com.com/
*/

class mi_twitter_conversacion
{
	function activate()
	{
		// Argumentos y sus valores por defecto
	    $aData = array( 'wTwitterUser' => albertofs,
	                    'wTitle' => 'La conversación en',
	                    'wSubject' => 'albertofortes.com',
	                    'wHeight' => '300',
	                    'wWidth' => '250',
	                    'wShellBg' => '#8ec1da',
	                    'wShellColor' => '#ffffff',
	                    'wTweetsBg' => '#ffffff',
	                    'wTweetsColor' => '#444444',
	                    'wTweetsLinks' => '#1986b5',
	                    'wScrollBar' => 'false',
	                    'wInterval' => '5000',
	                    'wAvatars' => 'true' );
	
	    // Comprobamos si existe opciones para este Widget, si no existe las creamos por el contrario actualizamos
	    if( ! get_option( 'twitterConversacion' ) )
	    	add_option( 'twitterConversacion' , $aData );
	    else
	        update_option( 'twitterConversacion' , $data);
    }

    function deactivate()
    {
        // Cuando se desactive el plugin se eliminaran todas las filas de la DB que le sirven a este plugin
        delete_option( 'twitterConversacion' );
    }
    
    // Panel de control que se mostrara abajo de nuestro Widget en el panel de configuración de Widgets
    function control()
    {
        $aData = get_option( 'twitterConversacion' );

        // Mostraremos un formulario en HTML para modificar los valores del Widget
        ?>
            <p>
                <label>Nombre del usuario de Twitter:</label>
                <input name="twitterConversacion_wTwitterUser" type="text" value="<?php echo $aData['wTwitterUser']; ?>" />
            </p>
            <p>
                <label>Título del widget:</label>
                <input name="twitterConversacion_wTitle" type="text" value="<?php echo $aData['wTitle']; ?>" />
            </p>
            <p>
                <label>Subject del widget:</label>
                <input name="twitterConversacion_wSubject" type="text" value="<?php echo $aData['wSubject']; ?>" />
            </p>
            <p>
                <label>Ancho:</label>
                <input name="twitterConversacion_wWidth" type="text" value="<?php echo $aData['wWidth']; ?>" />
            </p>
            <p>
                <label>Alto:</label>
                <input name="twitterConversacion_wHeight" type="text" value="<?php echo $aData['wHeight']; ?>" />
            </p>
            <p>
                <label>Color de fondo de la cabecera (en Hexadecimal, # obligatoria):</label>
                <input name="twitterConversacion_wShellBg" type="text" value="<?php echo $aData['wShellBg']; ?>" />
            </p>
            <p>
                <label>Color del texto de la cabecera (en Hexadecimal, # obligatoria):</label>
                <input name="twitterConversacion_wShellColor" type="text" value="<?php echo $aData['wShellColor']; ?>" />
            </p>
            <p>
                <label>Color de fondo del contenido (en Hexadecimal, # obligatoria)</label>
                <input name="twitterConversacion_wTweetsBg" type="text" value="<?php echo $aData['wTweetsBg']; ?>" />
            </p>
            <p>
                <label>Color del contenido (en Hexadecimal, # obligatoria):</label>
                <input name="twitterConversacion_wTweetsColor" type="text" value="<?php echo $aData['wTweetsColor']; ?>" />
            </p>
            <p>
                <label>Color de los enlaces (en Hexadecimal, # obligatoria):</label>
                <input name="twitterConversacion_wTweetsLinks" type="text" value="<?php echo $aData['wTweetsLinks']; ?>" />
            </p>
            <p>
                <label>Intervalo de tiempo en el que van a pareciendo los tweets (1000=1seg; por defecto 5 segundos):</label>
                <input name="twitterConversacion_wInterval" type="text" value="<?php echo $aData['wInterval']; ?>" />
            </p>
            <p>
                <label>¿Mostrar barra de scroll? (por defecto no)</label>
                <input type="radio" name="twitterConversacion_wScrollBar" value="false" checked="checked" /> No <input type="radio" name="twitterConversacion_wScrollBar" value="true" /> Si
            </p>
            <p>
                <label>¿Mostrar avatares? (por defecto si)</label>
                <input type="radio" name="twitterConversacion_wAvatars" value="false" /> No <input type="radio" name="twitterConversacion_wAvatars" value="true" checked="checked" /> Si
            </p>
        <?php

        // Si se ha enviado uno de los valores del formulario por POST actualizaremos los datos
        if( isset( $_POST['twitterConversacion_wTwitterUser'] ) )
        {
            $aData['wTwitterUser'] = attribute_escape( $_POST['twitterConversacion_wTwitterUser'] );
            $aData['wTitle'] = attribute_escape( $_POST['twitterConversacion_wTitle'] );
            $aData['wSubject'] = attribute_escape( $_POST['twitterConversacion_wSubject'] );
            $aData['wHeight'] = attribute_escape( $_POST['twitterConversacion_wHeight'] );
            $aData['wWidth'] = attribute_escape( $_POST['twitterConversacion_wWidth'] );
            $aData['wShellBg'] = attribute_escape( $_POST['twitterConversacion_wShellBg'] );
            $aData['wShellColor'] = attribute_escape( $_POST['twitterConversacion_wShellColor'] );
            $aData['wTweetsBg'] = attribute_escape( $_POST['twitterConversacion_wTweetsBg'] );
            $aData['wTweetsColor'] = attribute_escape( $_POST['twitterConversacion_wTweetsColor'] );
            $aData['wTweetsLinks'] = attribute_escape( $_POST['twitterConversacion_wTweetsLinks'] );
            $aData['wInterval'] = attribute_escape( $_POST['twitterConversacion_wInterval'] );
            $aData['wScrollBar'] = attribute_escape( $_POST['twitterConversacion_wScrollBar'] );
            $aData['wAvatars'] = attribute_escape( $_POST['twitterConversacion_wAvatars'] );

            update_option( 'twitterConversacion', $aData );
        }
    }
    
    // Metodo que se llamara cuando se visualize el Widget en pantalla
    function widget($args)
    {
    	// Variables
        $aData     = get_option( 'twitterConversacion' );
        
    	echo "<script src='http://widgets.twimg.com/j/2/widget.js'></script>";
	    echo "<script>";
	    echo "new TWTR.Widget({";
	    echo "version: 2,";
	    echo "type: 'search',";
	    echo "search: '". $aData['wTwitterUser'] . "',";
	    echo "interval: ". $aData['wInterval'] . ",";
	    echo "title: '". $aData['wTitle'] . "',";
	    echo "subject: '". $aData['wSubject'] . "',";
	    echo "width: ". $aData['wWidth'] . ",";
	    echo "height: ". $aData['wHeight'] . ",";
	    echo "theme: {";
	    echo "shell: {";
	    echo "background: '". $aData['wShellBg'] . "',";
	    echo "color: '". $aData['wShellColor'] . "'";
	    echo "},";
	    echo "tweets: {";
	    echo "background: '". $aData['wTweetsBg'] . "',";
	    echo "color: '". $aData['wTweetsColor'] . "',";
	    echo "links: '". $aData['wTweetsLinks'] . "'";
	    echo "}";
	    echo "},";
	    echo "features: {";
	    echo "scrollbar: ". $aData['wScrollBar'] . ",";
	    echo "loop: true,";
	    echo "live: true,";
	    echo "hashtags: true,";
	    echo "timestamp: true,";
	    echo "avatars: ". $aData['wAvatars'] . ",";
	    echo "toptweets: true,";
	    echo "behavior: 'default'";
	    echo "}";
	    echo "}).render().start();";
	    echo "</script>";
	    echo "<style type='text/css'>.twtr-widget {margin-bottom:20px;}</style>";
    }
    
    // Metodo que se llamara cuando se inicialice el Widget
    function register()
    {
        // Incluimos el widget en el panel control de Widgets
        register_sidebar_widget( 'Twitter widget conversación', array( 'mi_twitter_conversacion', 'widget' ) );

        // Formulario para editar las propiedades de nuestro Widget
        register_widget_control( 'Twitter widget conversación', array( 'mi_twitter_conversacion', 'control' ) );
    }
    
    
}

// Cuando se inicializa el widget llamaremos al metodo register de la clase mi_twitter_conversacion
add_action( 'widgets_init', array( 'mi_twitter_conversacion', 'register' ) );

// Cuando se active el plugin se llamara al metodo activate de la clase mi_twitter_conversacion
// donde añadiremos los argumentos por defecto para que funcione el plugin
register_activation_hook( __FILE__, array( 'mi_twitter_conversacion', 'activate' ) );

// Cuando se desactive el plugin se llamara al metodo desactivate de la clase mi_twitter_conversacion
// donde se eliminaran los argumentos anteriormente guardados
register_deactivation_hook( __FILE__, array( 'mi_twitter_conversacion', 'deactivate' ) );


//function init_twitter_conversacion(){register_sidebar_widget("Twitter widget conversación", "mi_twitter_conversacion");}

//add_action("plugins_loaded", "init_twitter_conversacion");
?>