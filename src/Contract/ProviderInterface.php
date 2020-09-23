<?php


namespace iikoExchangeBundle\Contract;

//TODO вынести библиотеку подключения к айко в отдельную библиотеку дабы отвязать ее от обмена вообще
// в обенной оставить только переопределение для песочницы
// в самом айковеб будет переопределние для клиентов
interface ProviderInterface
{
	/**
	 * Set connection specified by restaurant/user
	 * @param ConnectionInterface $connection
	 * @return $this
	 */
	public function withConnection(ConnectionInterface $connection) : self;

	/**
	 * Send a request
	 * @param RequestInterface $request
	 * @return mixed
	 */
	public function sendRequest(RequestInterface  $request);
}