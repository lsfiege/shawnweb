#include "legacyapps/camino_mcorto1/camino_mcorto1_message.h"
#ifdef ENABLE_CAMINO_MCORTO1

namespace camino_mcorto1
{
	camino_mcorto1Message::
		camino_mcorto1Message()
	{}

	camino_mcorto1Message::
		camino_mcorto1Message(int size)
	{
		setSize(size);
	}
	
	camino_mcorto1Message::
		~camino_mcorto1Message()
	{}
}
#endif
