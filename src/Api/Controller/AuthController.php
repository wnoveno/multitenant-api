<?php

namespace App\Api\Controller;

use App\Api\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AuthController extends Controller
{

    public function register(Request $request, JWTTokenManagerInterface $jwtManager)
    {
        $em = $this->getDoctrine()->getManager('tenant');
        $data = json_decode($request->getContent(), true);
        $user = $em->getRepository("Api:User")->findOneBy(['email' => $data['email_id']]);

        if($user != null){
            return new JsonResponse(['success' => false,
                'message' =>  'Email already exist.']);
        }

        $user = $em->getRepository("Api:User")->findOneBy(['username' => $data['name']]);
        if($user != null){
            return new JsonResponse(['success' => false,
                'message' =>  'Name already exists.']);
        }

        $user = new User();
        $user->setEmail($data['email_id']);
        $user->setUsername($data['name']);



        $defaultEncoder = new MessageDigestPasswordEncoder('sha512', true, 5000);
        $encoders = [
            User::class => $defaultEncoder, // Your user class. This line specify you ant sha512 encoder for this user class
        ];

        $encoderFactory = new EncoderFactory($encoders);
        $encoded = $encoderFactory->getEncoder($user)->encodePassword($data['password'], 'rmmapi');

        $user->setPassword($encoded);

        $em->persist($user);
        $em->flush();

        $em->persist($user);
        $em->flush();

        $token = $jwtManager->create($user);
        return new JsonResponse(['success' => true,
            'ResponsePacket' => $user->toData(),
            'message' => 'Registered successfully.',
            'token' => $token]);



    }

    public function login(Request $request, JWTTokenManagerInterface $jwtManager)
    {
        $em = $this->getDoctrine()->getManager('tenant');
        $data = json_decode($request->getContent(), true);

        $user = $em->getRepository("Api:User")->findOneBy(['email' => $data['email_id']]);

        if($user == null){
            return new JsonResponse(['success' => false, 'message'=> 'Invalid credentials.']);
        }else {

            $defaultEncoder = new MessageDigestPasswordEncoder('sha512', true, 5000);
            $encoders = [
                User::class => $defaultEncoder, // Your user class. This line specify you ant sha512 encoder for this user class
            ];

            $encoderFactory = new EncoderFactory($encoders);
            $encoded = $encoderFactory->getEncoder($user)->encodePassword($data['password'], 'rmmapi');

            if($user->getPassword() == $encoded)
            {
                $em->persist($user);
                $em->flush();

                $token = $jwtManager->create($user);
                return new JsonResponse(['success' => true,
                    'ResponsePacket' => $user->toData(),
                    'message' => 'Login successfully.',
                    'token' => $token]);
            }else {
                return new JsonResponse(['success' => false, 'message'=> 'Invalid credentials.']);
            }
        }


    }


    public function logout(Request $request)
    {
        $em = $this->getDoctrine()->getManager('tenant');
        $data = json_decode($request->getContent(), true);

        $user = $em->getRepository("Api:User")->find($data['_id']);

        if($user != null){
            return new JsonResponse(['success' => true,
                'ResponsePacket' => [],
                'message' => 'Successfully logout!']);
        }else {
            return new JsonResponse(['success' => false,
                'message' =>  'Invalid user id !',
                'ResponsePacket' => []]);
        }
    }


    public function forgotPassword($request)
    {
        $em = $this->getDoctrine()->getManager('tenant');
        $data = json_decode($request->getContent(), true);

        $user = $em->getRepository("Api:User")->findOneBy(['email' => $data['email_id']]);

        if($user == null){
            return new JsonResponse(['success' => false, 'message'=> 'Invalid email.']);
        }else {
            $code = uniqid();
                //Email
            $user->setSecureCode($code);
            $em->persist($user);
            $em->flush();

            return new JsonResponse(['success' => true, 'message'=> 'Please check your email for reset password.']);
        }

    }



}