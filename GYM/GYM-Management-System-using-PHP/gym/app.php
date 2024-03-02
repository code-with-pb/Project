<?phpsession_start();
error_reporting(0);
require_once('include/config.php');
if(strlen( $_SESSION["uid"])==0)
    {   
header('location:Booking-History.php');
}
else{
$uid=$_SESSION['uid'];
use \Phpml\Regression\LinearRegression;
use \Phpml\Math\Matrix;

function train_model(){
    $X_train = new Matrix([[4.5], [5.0], [5.5], [6.0], [6.5], [7.0]]);
    $y_train = [45, 50, 55, 60, 65, 70];

    $regression = new LinearRegression();
    $regression->train($X_train, $y_train);

    return $regression;
}

function predict_weight($height){
    $regression = train_model();
    $weight = $regression->predict([[$height]]);
    return $weight[0];
}

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\App;

require 'vendor/autoload.php';

$app = new App;

$app->get('/', function (Request $request, Response $response, array $args) {
    $output = "<h1>Weight Predictor</h1><p>Enter your height in feet:</p><form method='POST' action='/predict'><input type='text' name='height'><input type='submit' value='Predict'></form>";
    $response->getBody()->write($output);
    return $response;
});

$app->post('/predict', function (Request $request, Response $response, array $args) {
    $height = floatval($request->getParsedBody()['height']);
    $weight = predict_weight($height);
    return $response->withJson(['weight' => $weight]);
});

$app->run();
} ?>