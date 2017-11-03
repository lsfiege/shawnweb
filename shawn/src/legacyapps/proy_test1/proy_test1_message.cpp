#include "legacyapps/proy_test1/proy_test1_message.h"
#ifdef ENABLE_PROY_TEST1

namespace proy_test1
{
	proy_test1Message::
		proy_test1Message()
	{}

	proy_test1Message::
		proy_test1Message(int size)
	{
		setSize(size);
	}
	
	proy_test1Message::
		~proy_test1Message()
	{}
}
#endif
