#ifndef __SHAWN_LEGACYAPPS_PROY_TEST1_PROY_TEST1_PROCESSOR_H
#define __SHAWN_LEGACYAPPS_PROY_TEST1_PROY_TEST1_PROCESSOR_H
#include "_legacyapps_enable_cmake.h"
#ifdef ENABLE_PROY_TEST1

#include "sys/processor.h"
#include <set>

namespace proy_test1
{

   class proy_test1Processor
       : public shawn::Processor
   {
   public:
      proy_test1Processor();
      virtual ~proy_test1Processor();

      virtual void boot( void ) throw();
      virtual bool process_message( const shawn::ConstMessageHandle& ) throw();
      virtual void work( void ) throw();

   protected:
      int last_time_of_receive_;
      std::set<const shawn::Node*> neighbours_;
   };

}

#endif
#endif
