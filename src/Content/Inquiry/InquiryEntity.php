<?php declare(strict_types=1);

namespace HhagInquiry\Content\Inquiry;

use DateTimeInterface;
use Shopware\Core\Framework\DataAbstractionLayer\Entity;
use Shopware\Core\Framework\DataAbstractionLayer\EntityIdTrait;



class InquiryEntity extends Entity
{
    use EntityIdTrait;

    protected ?string  $inquiryNumber = null;
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    protected string $comment;
    protected $createdAt;

    /**
 * @return mixed
 */
public function getInquiryNumber()
{
    return $this->inquiryNumber;
}/**
 * @param mixed $inquiryNumber
 */
public function setInquiryNumber($inquiryNumber): void
{
    $this->inquiryNumber = $inquiryNumber;
}
public function getFirstName(): string
{
    return $this->firstName;
}
public function setFirstName(string $firstName): void
{
    $this->firstName = $firstName;
}
public function getLastName(): string
{
    return $this->lastName;
}
public function setLastName(string $lastName): void
{
    $this->lastName = $lastName;
}
public function getEmail(): string
{
    return $this->email;
}
public function setEmail(string $email): void
{
    $this->email = $email;
}
public function getComment(): string
{
    return $this->comment;
}
public function setComment(string $comment): void
{
    $this->comment = $comment;
}/**
 * @return ?DateTimeInterface
 */
public function getCreatedAt(): ?\DateTimeInterface
{
    return $this->createdAt;
}/**
 * @param mixed $createdAt
 */
public function setCreatedAt($createdAt): void
{
    $this->createdAt = $createdAt;
}
}