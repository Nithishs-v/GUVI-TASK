<?php

$redis = new Redis();

// Redis Cloud connection details
$redis_host = 'redis-cli -u redis://default:oKyR405Nx9Y2s4MquruYmpZxz3emVqmL@redis-11364.c275.us-east-1-4.ec2.redns.redis-cloud.com:11364'; 
$redis_port = 6379; // Default Redis port
$redisAuth="vO0v7Zno8sZsUE5PQO0e5UJZLp7YY7W7";

try {
    // Connect to Redis server
    $redis->connect($redis_host, $redis_port);

    // Authenticate with the password
    $redis->auth($redis_password);

    // Test the connection by setting and getting a value
    $redis->set('test_key', 'Hello Redis');
    $value = $redis->get('test_key');

    echo "Redis says: " . $value;
} catch (Exception $e) {
    echo "Could not connect to Redis: " . $e->getMessage();
}
?>
