<?php
$app->post('/api/Streetlayer/validateAddress', function ($request, $response, $args) {
    $settings = $this->settings;

    //checking properly formed json
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['apiKey', 'address1', 'countryCode', 'city']);
    if (!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback'] == 'error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    //forming request to vendor API
    $query_str = $settings['api_url'] . "validate";
    $body = array();
    $body['access_key'] = $post_data['args']['apiKey'];
    $body['address1'] = $post_data['args']['address1'];
    $body['country_code'] = $post_data['args']['countryCode'];
    $body['locality'] = $post_data['args']['city'];

    if (isset($post_data['args']['address2']) && strlen($post_data['args']['address2']) > 0) {
        $body['address2'] = $post_data['args']['address2'];
    }
    if (isset($post_data['args']['address3']) && strlen($post_data['args']['address3']) > 0) {
        $body['address3'] = $post_data['args']['address3'];
    }
    if (isset($post_data['args']['postalCode']) && strlen($post_data['args']['postalCode']) > 0) {
        $body['postal_code'] = $post_data['args']['postalCode'];
    }
    if (isset($post_data['args']['county']) && strlen($post_data['args']['county']) > 0) {
        $body['county'] = $post_data['args']['county'];
    }
    if (isset($post_data['args']['region']) && strlen($post_data['args']['region']) > 0) {
        $body['region'] = $post_data['args']['region'];
    }

    //requesting remote API
    $client = new GuzzleHttp\Client();

    try {

        $resp = $client->request('GET', $query_str, [
            'query' => $body
        ]);

        $responseBody = $resp->getBody()->getContents();
        $rawBody = json_decode($resp->getBody());

        $all_data[] = $rawBody;
        if ($response->getStatusCode() == '200' && $rawBody->success) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($all_data) ? $all_data : json_decode($all_data);
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {
        $responseBody = $exception->getResponse()->getReasonPhrase();
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $responseBody;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    } catch (GuzzleHttp\Exception\BadResponseException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to'] = json_decode($responseBody);

    }


    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});