#ifndef __SHAWN_LEGACYAPPS_PROY_TEST1_PROY_TEST1_MESSAGE_H
#define __SHAWN_LEGACYAPPS_PROY_TEST1_PROY_TEST1_MESSAGE_H
#include "_legacyapps_enable_cmake.h"
#ifdef ENABLE_PROY_TEST1

#include "sys/message.h"

namespace proy_test1
{

   class proy_test1Message
       : public shawn::Message
   {
   public:
	   proy_test1Message();
	   proy_test1Message(int);
	   virtual ~proy_test1Message();
   };

}

#endif
#endif
