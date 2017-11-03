#include "legacyapps/legacyapps_init.h"
#include "_legacyapps_init_cmake.h"
#include <iostream>
#include <stdio.h>

//See: http://gcc.gnu.org/onlinedocs/cpp/Stringification.html (2nd example)
#define xstr(s) str(s)
#define str(s) #s

namespace shawn
{
	void init_legacyapps( SimulationController& sc )
	{
		std::cout << "init_legacyapps: " << xstr(INIT_STATIC_LEGACYAPPS_MODULES) << std::endl;
		
		INIT_STATIC_LEGACYAPPS_MODULES;
	}
}
